<?php

declare(strict_types=1);

namespace Tests\Feature\Api;

use App\Mail\Sample;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Testing\Fakes\MailFake;
use Tests\TestCase;

class MailTest extends TestCase
{
    /**
     * @test
     */
    public function post_send_mail()
    {
        $response = $this->postJson(
            '/api/send-email',
            [
                'to' => 'a@example.com',
            ]
        );

        $response->assertStatus(200);
        $response->assertExactJson(['ok']);
    }

    /**
     * @test
     */
    public function MailFakeを利用したテスト()
    {
        $fakerMailer = new MailFake();
        $this->app->singleton(
            'mailer',
            function () use ($fakerMailer) {
                return $fakerMailer;
            }
        );

        $response = $this->postJson(
            '/api/send-email',
            [
                'to' => 'a@example.com',
            ]
        );

        $response->assertStatus(200);

        $fakerMailer->assertSent(Sample::class, 1);
        $fakerMailer->assertSent(
            Sample::class,
            function (Mailable $mailable) {
                return $mailable->hasTo('a@example.com');
            }
        );
    }

    /**
     * @test
     */
    public function Mail_퍼사드_face를_이용한_테스트()
    {
        Mail::fake();

        $response = $this->postJson(
            '/api/send-email-facade',
            [
                'to' => 'a@example.com',
            ]
        );

        $response->assertStatus(200);

        Mail::assertSent(Sample::class, 1);
        Mail::assertSent(
            function (Mailable $mailable) {
                return $mailable->hasTo('a@example.com');
            }
        );
    }

    /**
     * @test
     */
    public function Mail_퍼사드_fake를_이용한_테스트_DIファサードfakeを利用したテスト_DI()
    {
        Mail::fake();

        $response = $this->postJson(
            '/api/send-email',
            [
                'to' => 'a@example.com',
            ]
        );

        $response->assertStatus(200);

        Mail::assertSent(Sample::class, 1);
        Mail::assertSent(
            Sample::class,
            function (Mailable $mailable) {
                return $mailable->hasTo('a@example.com');
            }
        );
    }
}
