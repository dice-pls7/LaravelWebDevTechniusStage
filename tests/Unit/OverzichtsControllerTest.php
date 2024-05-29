<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\OverzichtsController;
use App\Repositories\KandidaatRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Validation\Rules\DatabaseRule;

class OverzichtsControllerTest extends TestCase
{
    use DatabaseTransactions;
    public function testOverzicht()
    {
        // Mock de KandidaatRepository
        $kandidaatRepository = $this->createMock(KandidaatRepository::class);
        $viewFactory = app(ViewFactory::class); // Instantieer de view-fabriek via de Laravel-servicecontainer

        // Maak een instantie van de controller en injecteer de mock van de KandidaatRepository
        $controller = new OverzichtsController($kandidaatRepository, $viewFactory);

        // Verwachte gegevens
        $kandidaten = ['kandidaat1', 'kandidaat2'];
        $paginatedKandidaten = new Paginator($kandidaten, count($kandidaten), 12);

        // Stel de verwachte methode-oproep in voor de mock
        $kandidaatRepository->expects($this->once())
            ->method('getAllOrderedByPinned')
            ->willReturn($paginatedKandidaten);

        // Roep de methode aan die je wilt testen
        $response = $controller->overzicht();

        // Voer assertions uit op de response
        $this->assertEquals('overzicht', $response->name());
        $this->assertEquals($paginatedKandidaten, $response->getData()['kandidaten']);
    }
    //maak een test voor de details methode
    public function testDetails()
    {
        // Mock de KandidaatRepository
        $kandidaatRepository = $this->createMock(KandidaatRepository::class);
        $viewFactory = app(ViewFactory::class); // Instantieer de view-fabriek via de Laravel-servicecontainer

        // Maak een instantie van de controller en injecteer de mock van de KandidaatRepository
        $controller = new OverzichtsController($kandidaatRepository, $viewFactory);

        // Verwachte gegevens
        $kandidaat = 'kandidaat';
        $reviews = ['review1', 'review2'];

        // Stel de verwachte methode-oproep in voor de mock
        $kandidaatRepository->expects($this->once())
            ->method('getKandidaat')
            ->with(1)
            ->willReturn($kandidaat);

        $kandidaatRepository->expects($this->once())
            ->method('getReviews')
            ->with(1)
            ->willReturn($reviews);

        // Roep de methode aan die je wilt testen
        $response = $controller->details(1);

        // Voer assertions uit op de response
        $this->assertEquals('details', $response->name());
        $this->assertEquals($kandidaat, $response->getData()['kandidaat']);
        $this->assertEquals($reviews, $response->getData()['reviews']);
    }
    //maak een test voor de wijzigen methode
    public function testWijzigen()
    {
        // Mock de KandidaatRepository
        $kandidaatRepository = $this->createMock(KandidaatRepository::class);
        $viewFactory = app(ViewFactory::class); // Instantieer de view-fabriek via de Laravel-servicecontainer

        // Maak een instantie van de controller en injecteer de mock van de KandidaatRepository
        $controller = new OverzichtsController($kandidaatRepository, $viewFactory);

        // Verwachte gegevens
        $kandidaat = 'kandidaat';

        // Stel de verwachte methode-oproep in voor de mock
        $kandidaatRepository->expects($this->once())
            ->method('getKandidaatGegevens')
            ->with(1)
            ->willReturn($kandidaat);

        // Roep de methode aan die je wilt testen
        $response = $controller->wijzigen(1);

        // Voer assertions uit op de response
        $this->assertEquals('wijzigen', $response->name());
        $this->assertEquals($kandidaat, $response->getData()['kandidaat']);
    }
    public function testDetailsWithInvalidKandidaat()
    {
    // Mock de KandidaatRepository
    $kandidaatRepository = $this->createMock(KandidaatRepository::class);
    $viewFactory = app(ViewFactory::class); // Instantieer de view-fabriek via de Laravel-servicecontainer

    // Maak een instantie van de controller en injecteer de mock van de KandidaatRepository
    $controller = new OverzichtsController($kandidaatRepository, $viewFactory);

    // Stel de verwachte methode-oproep in voor de mock
    $kandidaatRepository->expects($this->once())
        ->method('getKandidaat')
        ->with(999) // Gebruik een ID waarvan je weet dat het niet bestaat
        ->willReturn(null);

    $kandidaatRepository->expects($this->once())
        ->method('getReviews')
        ->with(999)
        ->willReturn([]);

    // Roep de methode aan die je wilt testen
    $response = $controller->details(999);

    // Voer assertions uit op de response
    $this->assertEquals('details', $response->name());
    $this->assertNull($response->getData()['kandidaat']);
    $this->assertEquals([], $response->getData()['reviews']);
    }
}