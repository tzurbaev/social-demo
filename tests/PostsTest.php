<?php

use App\Contracts\Activities\ActivityManagerContract;
use App\Image;
use App\Post;
use App\User;
use App\Video;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class PostsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function image_post_should_contain_only_images()
    {
        // Create author, single image and post.
        // Attach image to post.
        // Assert that post type is 'image'.
        $author = factory(User::class)->create();
        $image = factory(Image::class)->create();

        $post = factory(Post::class)->create([
            'author_id' => $author->id,
            'message' => '',
        ]);
        $post->attach($image);

        $this->assertEquals('image', $post->type);
    }

    /** @test */
    function video_post_should_contain_only_videos()
    {
        // Create author, single video and post.
        // Attach video to post.
        // Assert that post type is 'video'.
        $author = factory(User::class)->create();
        $video = factory(Video::class)->create();

        $post = factory(Post::class)->create([
            'author_id' => $author->id,
            'message' => '',
        ]);
        $post->attach($video);

        $this->assertEquals('video', $post->type);
    }

    /** @test */
    function regular_post_can_contain_mixed_content()
    {
        // Create author, single image, single video and post with message.
        // Attach image to post.
        // Assert that post type is 'post'.
        $author = factory(User::class)->create();
        $image = factory(Image::class)->create();
        $video = factory(Video::class)->create();

        $post = factory(Post::class)->create([
            'author_id' => $author->id,
            'message' => 'Hello world',
        ]);
        $post->attach($image);
        $post->attach($video);

        $this->assertEquals('post', $post->type);
    }
}
