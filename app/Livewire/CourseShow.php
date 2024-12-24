<?php

namespace App\Livewire;

use App\Models\Chapter;
use App\Models\Comment;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CourseShow extends Component
{
    public $course;

    public $chapter;

    public $comments = [];

    public $comment;

    public $has_purchased = false;

    public $course_locked = true;

    public function mount(Course $course, Chapter $chapter)
    {
        $this->course = $course;

        $related_chapters = $course->related_chapters();

        // if chapter_id is present in the route URL
        if ($chapter->id) {

            $this->chapter = $chapter;

            // check if this is the first free chapter to unlock
            if ($related_chapters->get()->count() && $related_chapters->limit(1)->get()[0]->id == $chapter->id) {

                $this->course_locked = false;

                //dd($related_chapters->limit(1)->get()[0]->id == $chapter->id);
            }

        } else {
            $this->chapter = $related_chapters->get()->count() ? $related_chapters->limit(1)->get()[0] : null;

            $this->course_locked = false;
        }

        if ($this->chapter) {
            $this->comments = $this->chapter->comments;
        }

        // unlock course if course price is not defined, or user visited the first chapter
        if ($course->price == null) {
            $this->has_purchased = true;
        }

        // unlock course if user has paid
        if (Auth::check()) {
            foreach ($course->payments as $payment) {

                if ($payment->course_id == $course->id && $payment->user_id == Auth::id()) {
                    $this->has_purchased = true;
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.course-show');
    }

    public function post_comment()
    {
        $this->validate([
            'comment' => 'required|min:20|max:3000',
        ]);

        if (! Auth::check()) {

            session()->flash('message', 'Please log in to post a comment.');

            return;
        }

        $new_comment = new Comment;

        $new_comment->comment = $this->comment;
        $new_comment->chapter_id = $this->chapter->id;
        $new_comment->user_id = Auth::id();

        $new_comment->save();

        session()->flash('message', 'Comment posted successfully.');

        $this->comments = $this->chapter->comments;
        //$this->comment = '';
    }

    public function delete_comment(Comment $comment_to_delete)
    {
        $comment_to_delete->delete();

        $this->comments = $this->chapter->comments;
    }
}
