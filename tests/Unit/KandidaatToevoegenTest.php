<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\OverzichtsController;
use App\Http\Controllers\KandidaatToevoegenController;
use App\Repositories\KandidaatRepository; 
use App\Models\Kandidaat; 
use Illuminate\Pagination\Paginator;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Validation\Rules\DatabaseRule;
use Illuminate\Http\Request;


class KandidaatToevoegenTest extends TestCase
{
    use DatabaseTransactions;
    public function testKandidaatToevoegen()
    {
        // Mock de KandidaatRepository
        $kandidaatRepository = $this->createMock(KandidaatRepository::class);
        $viewFactory = app(ViewFactory::class); // Instantieer de view-fabriek via de Laravel-servicecontainer

        // Maak een instantie van de controller en injecteer de mock van de KandidaatRepository
        $controller = new KandidaatToevoegenController($kandidaatRepository, $viewFactory);

        // Maak een instantie van de kanidaat
        $kandidaat = new Kandidaat(
            null,
            'Jan',
            'van',
            'Jansen',
            '1990-01-01',
            'Elektromonteur',
            '40',
            '1',
            'Amsterdam',
            'Nederlands',
            '5',
            'Bedrijf1, Bedrijf2',
            'MBO 4',
            'VCA',
            'Ik ben een kandidaat',
            '0'
        );

        // Verwacht dat de methode insertKandidaat van de KandidaatRepository wordt aangeroepen met de juiste parameters
        $kandidaatRepository->expects($this->once())
            ->method('insertKandidaat')
            ->with($kandidaat);

        // Maak een request-object met de juiste parameters
        $request = new Request([
            'Voornaam' => 'Jan',
            'Tussenvoegsel' => 'van',
            'Achternaam' => 'Jansen',
            'Geboortedatum' => '1990-01-01',
            'Functie' => 'Elektromonteur',
            'Beschikbaarheid' => '40',
            'Beschikbaar' => '1',
            'Locatie' => 'Amsterdam',
            'Taal' => 'Nederlands',
            'Werkervaring' => '5',
            'OudeOpdrachtgevers' => 'Bedrijf1, Bedrijf2',
            'Diplomas' => 'MBO 4',
            'Certificaten' => 'VCA',
            'FlavourText' => 'Ik ben een kandidaat',
            'pinned' => '0'
        ]);
        // Roep de methode aan met het request-object
        $response = $controller->toevoegen($request);

        $this->assertEquals(302, $response->getStatusCode());
    }
}
