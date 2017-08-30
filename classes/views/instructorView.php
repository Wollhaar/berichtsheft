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

    public function getInstTemplateEditInstructor(){
        return $this->instTemplate['editInstructor'];
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

    public function setInstTemplateEditInstructor($edit){
        $this->instTemplate['editInstructor'] = $edit;
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
            'editInstructor',
            'footer',
            'scripts',
        ];
    }

    function loadDefaultPage()
    {
        var_dump($_POST);
        $this->setInstTemplateHeader(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructor/header.html'));
        $this->setInstTemplateMainNavigation(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructor/mainNavigation.html'));
        $this->setInstTemplateBody(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructor/instructor.html'));
        $this->setInstTemplateFooter(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructor/footer.html'));
        $this->setInstTemplateScripts(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructor/instructorScripts.html'));

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

//          $recordTemplate = readfile($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/recordDbInstructor.html');
//          readFile liest die datei als file ein daher kann kein String replace über die Variable gemacht werden
//          file_get_cotent liest die file als String ein
            $recordTemplate = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructor/recordDbInstructor.html');


            $search = [
                'prop1' => '###NAME###',
                'prop2' => '###VORNAME###',
                'prop3' => '###ROLE###',
                'prob4' => '###instId###'
            ];
            $replace = [
                $entry['name'],
                $entry['vorname'],
                $entry['role'],
                $entry['instructor_id']
            ];

            $recordTemplate = str_replace($search, $replace, $recordTemplate);
            $content .= $recordTemplate;
        }


        switch ($operator) {

            case 'enterprice': {
                $this->setInstTemplateHeader(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructor/header.html'));
                $this->setInstTemplateMainNavigation(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructor/mainNavigation.html'));
                $this->setInstTemplateBody(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructor/instructor.html'));
                $this->setInstTemplateEnterprice(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructor/enterpriceShow.html'));
                $this->setInstTemplateFooter(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructor/footer.html'));
                $this->setInstTemplateScripts(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructor/generallJavaScripts.html'));

                $this->setInstTemplateEnterprice(str_replace('###CONTENT###',
                    $content, $this->getInstTemplateEnterprice()));

                $this->printSide($this);
                break;
            }
            case 'school': {
                $this->setInstTemplateHeader(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructor/header.html'));
                $this->setInstTemplateMainNavigation(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructor/mainNavigation.html'));
                $this->setInstTemplateBody(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructor/instructor.html'));
                $this->setInstTemplateSchool(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructor/schoolShow.html'));
                $this->setInstTemplateFooter(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructor/footer.html'));
                $this->setInstTemplateScripts(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructor/generallJavaScripts.html'));

                $this->setInstTemplateSchool(str_replace('###CONTENT###',
                    $content, $this->getInstTemplateSchool()));

                $this->printSide($this);
                break;
            }
            case 'extern': {
                $this->setInstTemplateHeader(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructor/header.html'));
                $this->setInstTemplateMainNavigation(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructor/mainNavigation.html'));
                $this->setInstTemplateBody(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructor/instructor.html'));
                $this->setInstTemplateExtern(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructor/externShow.html'));
                $this->setInstTemplateFooter(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructor/footer.html'));
                $this->setInstTemplateScripts(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructor/generallJavaScripts.html'));

                $this->setInstTemplateExtern(str_replace('###CONTENT###',
                    $content, $this->getInstTemplateExtern()));

                $this->printSide($this);
                break;
            }
            case 'add':{
                var_dump($_REQUEST);
                $this->setInstTemplateHeader(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructor/header.html'));
                $this->setInstTemplateMainNavigation(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructor/mainNavigation.html'));
                $this->setInstTemplateBody(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructor/instructor.html'));
                $this->setInstTemplateEditFormular(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructor/instructorEditFormular.html'));
                $this->setInstTemplateFooter(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructor/footer.html'));
                $this->setInstTemplateScripts(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructor/instructorScripts.html'));
                $this->setInstTemplateScripts(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructor/generallJavaScripts.html'));


                $this->printSide($this);
                break;
            }
        }
    }

    function renderEdit($info, $id, $operator){

        $dbchange = explode(',', $info);

        $writeTemplate = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructor/editInstructor.html');

        $search = [
            'prob1' => '###name###',
            'prob2' => '###vorname###',
            'prob3' => '###role###',
            'prob4' => '###instId###',
        ];

        $replace = [
            $dbchange[0],
            $dbchange[1],
            $dbchange[2],
            $id
        ];

        $writeTemplate = str_replace($search, $replace, $writeTemplate);

        switch ($operator){

            case 'edit':{
                var_dump($_REQUEST);
                $this->setInstTemplateHeader(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructor/header.html'));
                $this->setInstTemplateMainNavigation(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructor/mainNavigation.html'));
                $this->setInstTemplateBody(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructor/instructor.html'));
                $this->setInstTemplateEditInstructor($writeTemplate);
                $this->setInstTemplateFooter(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructor/footer.html'));
                $this->setInstTemplateScripts(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructor/generallJavaScripts.html'));
                $this->printSide($this);

                break;
            }
        }
    }
}