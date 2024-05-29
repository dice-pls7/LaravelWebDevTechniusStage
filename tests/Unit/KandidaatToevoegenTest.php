<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\OverzichtsController;
use App\Http\Controllers\KandidaatToevoegenController;
use App\Repositories\KandidaatRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Validation\Rules\DatabaseRule;
use Illuminate\Http\Request;


class KandidaatToevoegenTest extends TestCase
{
    use DatabaseTransactions;
    public function testHandleToevoegenKandidaat()
    {
       
    }
}
