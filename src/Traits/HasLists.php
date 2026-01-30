<?php

declare(strict_types=1);

namespace ScreenScraper\Traits;

use ScreenScraper\Data\List\ClassificationsData;
use ScreenScraper\Data\List\FamiliesData;
use ScreenScraper\Data\List\GenresData;
use ScreenScraper\Data\List\LanguagesData;
use ScreenScraper\Data\List\RegionsData;
use ScreenScraper\Data\List\RomTypesData;
use ScreenScraper\Data\List\SupportTypesData;

trait HasLists
{
    /**
     * @link https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0#supportTypesListe
     *
     * @return SupportTypesData|array<string, mixed>
     */
    public function getSupportTypes(): SupportTypesData|array
    {
        $data = $this->call('supportTypesListe.php');

        return $this->response($data, SupportTypesData::class);
    }

    /**
     * @link https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0#romTypesListe
     *
     * @return RomTypesData|array<string, mixed>
     */
    public function getRomTypes(): RomTypesData|array
    {
        $data = $this->call('romTypesListe.php');

        return $this->response($data, RomTypesData::class);
    }

    /**
     * @link https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0#regionsListe
     *
     * @return RegionsData|array<string, mixed>
     */
    public function getRegions(): RegionsData|array
    {
        $data = $this->call('regionsListe.php');

        return $this->response($data, RegionsData::class);
    }

    /**
     * @link https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0#languesListe
     *
     * @return LanguagesData|array<string, mixed>
     */
    public function getLanguages(): LanguagesData|array
    {
        $data = $this->call('languesListe.php');

        return $this->response($data, LanguagesData::class);
    }

    /**
     * @link https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0#genresListe
     *
     * @return GenresData|array<string, mixed>
     */
    public function getGenres(): GenresData|array
    {
        $data = $this->call('genresListe.php');

        return $this->response($data, GenresData::class);
    }

    /**
     * @link https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0#famillesListe
     *
     * @return FamiliesData|array<string, mixed>
     */
    public function getFamilies(): FamiliesData|array
    {
        $data = $this->call('famillesListe.php');

        return $this->response($data, FamiliesData::class);
    }

    /**
     * @link https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0#classificationsListe
     *
     * @return ClassificationsData|array<string, mixed>
     */
    public function getClassifications(): ClassificationsData|array
    {
        $data = $this->call('classificationsListe.php');

        return $this->response($data, ClassificationsData::class);
    }
}
