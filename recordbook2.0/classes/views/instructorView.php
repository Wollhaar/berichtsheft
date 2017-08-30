<?php
class instructorView
{

    private $instTemplate;

    /**
     * @return mixed
     */
    public function getInstTemplate()
    {
        return $this->instTemplate;
    }

    public function getInstTemplateHeader()
    {
        return $this->instTemplate['header'];
    }

    public function getInstTemplateNavigation()
    {
        return $this->instTemplate['mainNavigation'];
    }

    public function getInstTemplateFormlar()
    {
        return $this->instTemplate['editFormular'];
    }

    public function getInstTemplateBody()
    {
        return $this->instTemplate['body'];
    }

    public function getInstTemplateEnterprice()
    {
        return $this->instTemplate['enterprice'];
    }

    public function getInstTemplateFooter()
    {
        return $this->instTemplate['footer'];
    }

    public function getInstTemplateSchool()
    {
        return $this->instTemplate['school'];
    }

    public function getInstTemplateExtern()
    {
        return $this->instTemplate['extern'];
    }

    public function getInstTemplateScripts()
    {
        return $this->instTemplate['scripts'];
    }

    /**
     * @param mixed $instTemplate
     */
    public function setInstTemplate($instTemplate)
    {
        $this->instTemplate = $instTemplate;
    }

    public function setInstTemplateHeader($header)
    {
        $this->instTemplate['header'] = $header;
    }

    public function setInstTemplateMainNavigation($mainNavigation)
    {
        $this->instTemplate['mainNavigation'] = $mainNavigation;
    }

    public function setInstTemplateEditFormular($editFormular)
    {
        $this->instTemplate['editFormular'] = $editFormular;
    }

    public function setInstTemplateBody($body)
    {
        $this->instTemplate['body'] = $body;
    }

    public function setInstTemplateEnterprice($enterprise)
    {
        $this->instTemplate['enterprice'] = $enterprise;
    }

    public function setInstTemplateFooter($footer)
    {
        $this->instTemplate['footer'] = $footer;
    }

    public function setInstTemplateScripts($scripts)
    {
        $this->instTemplate['scripts'] = $scripts;
    }

    public function setInstTemplateSchool($school)
    {
        $this->instTemplate['school'] = $school;
    }

    public function setInstTemplateExtern($extern)
    {
        $this->instTemplate['extern'] = $extern;
    }


    function __construct()
    {
        $instTemplate = [
            'header',
            'mainNavigation',
            'editFormular',
            'body',
            'enterprice',
            'school',
            'extern',
            'footer',
            'scripts',
        ];
    }

    function loadDefaultPage()
    {
        $this->setInstTemplateHeader(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/recordbook2.0/resources/partials/instructor/header.html'));
        $this->setInstTemplateMainNavigation(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/recordbook2.0/resources/partials/mainNavigation.html'));
        $this->setInstTemplateBody(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/recordbook2.0/resources/partials/instructor/instructor.html'));
        $this->setInstTemplateFooter(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/recordbook2.0/resources/partials/footer.html'));
        $this->setInstTemplateScripts(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/recordbook2.0/resources/partials/instructor/instructorScripts.html'));

        $this->printSide($this);
    }

    function printSide($instrTemplate)
    {
        foreach ($instrTemplate as $sideContent) {
            foreach ($sideContent as $content) {
                echo $content;
            }
        }
    }

    function render($dbArray, $operator)
    {
// switch case, was angezeigt werden soll (Betrieb/Schule/Extern) - z.B. über Request-Parameter
// (die Seite wird ja neu geladen, wenn man auf der Seite einen der Links angeklickt, da kann man dann den Parameter ranhängen.
        $dbEntries = $dbArray; // deine DB-Methode, um die Daten zu holen
        $content = '';

        foreach ($dbEntries as $entry) {

//          $recordTemplate = readfile($_SERVER['DOCUMENT_ROOT'] . '/recordbook2.0/resources/templates/partials/recordDbInstructor.html');
//          readFile liest die datei als file ein daher kann kein String replace über die Variable gemacht werden
//          file_get_cotent liest die file als String ein
            $recordTemplate = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/recordbook2.0/resources/partials/instructor/recordDbInstructor.html');


            $search = [
                'prop1' => '###NAME###',
                'prop2' => '###VORNAME###',
                'prop3' => '###ROLE###',
            ];
            $replace = [
                $entry['name'],
                $entry['vorname'],
                $entry['role'],
            ];

            $recordTemplate = str_replace($search, $replace, $recordTemplate);
            $content .= $recordTemplate;
        }

        switch ($operator) {

            case 'enterprice': {
                $this->setInstTemplateHeader(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/recordbook2.0/resources/partials/instructor/header.html'));
                $this->setInstTemplateMainNavigation(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/recordbook2.0/resources/partials/instructor/mainNavigation.html'));
                $this->setInstTemplateBody(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/recordbook2.0/resources/partials/instructor/instructor.html'));
                $this->setInstTemplateEnterprice(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/recordbook2.0/resources/partials/instructor/enterpriceShow.html'));
                $this->setInstTemplateFooter(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/recordbook2.0/resources/partials/instructor/footer.html'));

                $this->setInstTemplateEnterprice(str_replace('###CONTENT###',
                    $content, $this->getInstTemplateEnterprice()));

                $this->printSide($this);
                break;
            }
            case 'school': {
                $this->setInstTemplateHeader(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/recordbook2.0/resources/partials/instructor/header.html'));
                $this->setInstTemplateMainNavigation(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/recordbook2.0/resources/partials/instructor/mainNavigation.html'));
                $this->setInstTemplateBody(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/recordbook2.0/resources/partials/instructor/instructor.html'));
                $this->setInstTemplateSchool(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/recordbook2.0/resources/partials/instructor/schoolShow.html'));
                $this->setInstTemplateFooter(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/recordbook2.0/resources/partials/instructor/footer.html'));

                $this->setInstTemplateSchool(str_replace('###CONTENT###',
                    $content, $this->getInstTemplateSchool()));

                $this->printSide($this);
                break;
            }
            case 'extern': {
                $this->setInstTemplateHeader(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/recordbook2.0/resources/partials/instructor/header.html'));
                $this->setInstTemplateMainNavigation(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/recordbook2.0/resources/partials/instructor/mainNavigation.html'));
                $this->setInstTemplateBody(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/recordbook2.0/resources/partials/instructor/instructor.html'));
                $this->setInstTemplateExtern(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/recordbook2.0/resources/partials/instructor/externShow.html'));
                $this->setInstTemplateFooter(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/recordbook2.0/resources/partials/instructor/footer.html'));

                $this->setInstTemplateExtern(str_replace('###CONTENT###',
                    $content, $this->getInstTemplateExtern()));

                $this->printSide($this);
                break;
            }
            case 'add':{
                $this->setInstTemplateHeader(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/recordbook2.0/resources/partials/instructor/header.html'));
                $this->setInstTemplateMainNavigation(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/recordbook2.0/resources/partials/instructor/mainNavigation.html'));
                $this->setInstTemplateBody(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/recordbook2.0/resources/partials/instructor/instructor.html'));
                $this->setInstTemplateEditFormular(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/recordbook2.0/resources/partials/instructor/instructorEditFormular.html'));
                $this->setInstTemplateFooter(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/recordbook2.0/resources/partials/instructor/footer.html'));
                $this->setInstTemplateScripts(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/recordbook2.0/resources/partials/instructor/instructorScripts.html'));


                $this->printSide($this);
                break;


            }
        }
    }
}