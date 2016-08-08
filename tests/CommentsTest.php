<?php

use App\Comment;
use App\Image;
use App\Post;
use App\User;
use App\Video;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class CommentsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function post_can_be_commented()
    {
        // Create author, create post.
        // Create comment author, write comment on post.
        // Assert that post's comments count equals 1.
        $author = factory(User::class)->create();
        $post = factory(Post::class)->create([
            'author_id' => $author->id,
            'message' => 'Hello, world',
        ]);
        $comment = factory(Comment::class)->create([
            'author_id' => $author->id,
            'message' => 'Commenting on Hello, world...',
        ]);

        $post->discuss($comment);

        $this->assertEquals(1, $post->commentsCount());
    }

    /** @test */
    function image_can_be_commented()
    {
        // Create image, create comment author, write comment on image.
        // Assert that image's comments count equals 1.
        $author = factory(User::class)->create();
        $image = factory(Image::class)->create();
        $comment = factory(Comment::class)->create([
            'author_id' => $author->id,
            'message' => 'Commenting on Image...',
        ]);

        $image->discuss($comment);

        $this->assertEquals(1, $image->commentsCount());
    }

    /** @test */
    function video_can_be_commented()
    {
        // Create video, create comment author, write comment on video.
        // Assert that video's comments count equals 1.
        $author = factory(User::class)->create();
        $video = factory(Video::class)->create();
        $comment = factory(Comment::class)->create([
            'author_id' => $author->id,
            'message' => 'Commenting on Video...',
        ]);

        $video->discuss($comment);

        $this->assertEquals(1, $video->commentsCount());
    }

    /** @test */
    function comment_reply_can_be_created()
    {
        // Create video, create comment author, write comment on video.
        // Create second comment in reply to original comment.
        // Assert that video's comments count equals 2.
        // Assert that second comment's replyTo() ID equals original comment ID.
        $author = factory(User::class)->create();
        $video = factory(Video::class)->create();
        $comment = factory(Comment::class)->create([
            'author_id' => $author->id,
            'message' => 'Commenting on Video...',
        ]);

        $video->discuss($comment);

        $secondComment = factory(Comment::class)->create([
            'author_id' => $author->id,
            'message' => 'Replying to first comment on Video...',
            'reply_to_comment_id' => $comment->id,
        ]);

        $video->discuss($secondComment);

        $this->assertEquals(2, $video->commentsCount());
        $this->assertEquals($comment->id, $secondComment->replyTo()->id);
    }
}
