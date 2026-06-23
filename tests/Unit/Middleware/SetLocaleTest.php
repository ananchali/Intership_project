<?php

namespace Tests\Unit\Middleware;

use App\Http\Middleware\SetLocale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class SetLocaleTest extends TestCase
{
    private SetLocale $middleware;

    protected function setUp(): void
    {
        parent::setUp();
        $this->middleware = new SetLocale();
    }

    public function test_sets_locale_from_session(): void
    {
        $request = Request::create('/test', 'GET');
        $request->setLaravelSession(session()->driver());
        session(['locale' => 'am']);

        $this->middleware->handle($request, function ($req) {
            $this->assertEquals('am', App::getLocale());
        });
    }

    public function test_defaults_to_english_when_no_session_locale(): void
    {
        $request = Request::create('/test', 'GET');
        $request->setLaravelSession(session()->driver());

        $this->middleware->handle($request, function ($req) {
            $this->assertEquals('en', App::getLocale());
        });
    }

    public function test_defaults_to_english_for_unsupported_locale(): void
    {
        $request = Request::create('/test', 'GET');
        $request->setLaravelSession(session()->driver());
        session(['locale' => 'fr']);

        $this->middleware->handle($request, function ($req) {
            $this->assertEquals('en', App::getLocale());
        });
    }

    public function test_supports_amharic_locale(): void
    {
        $request = Request::create('/test', 'GET');
        $request->setLaravelSession(session()->driver());
        session(['locale' => 'am']);

        $this->middleware->handle($request, function ($req) {
            $this->assertEquals('am', App::getLocale());
        });
    }

    public function test_supports_oromo_locale(): void
    {
        $request = Request::create('/test', 'GET');
        $request->setLaravelSession(session()->driver());
        session(['locale' => 'om']);

        $this->middleware->handle($request, function ($req) {
            $this->assertEquals('om', App::getLocale());
        });
    }

    public function test_supports_somali_locale(): void
    {
        $request = Request::create('/test', 'GET');
        $request->setLaravelSession(session()->driver());
        session(['locale' => 'so']);

        $this->middleware->handle($request, function ($req) {
            $this->assertEquals('so', App::getLocale());
        });
    }

    public function test_passes_request_to_next_middleware(): void
    {
        $request = Request::create('/test', 'GET');
        $request->setLaravelSession(session()->driver());

        $called = false;
        $this->middleware->handle($request, function ($req) use (&$called) {
            $called = true;
            return response('OK');
        });

        $this->assertTrue($called);
    }
}
