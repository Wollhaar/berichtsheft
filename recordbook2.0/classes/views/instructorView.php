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






    public function getInstTemplateHeader(){
        return $this->instTemplate['header'];
    }
    public function getInstTemplateNavigation(){
        return $this->instTemplate['mainNavigation'];
    }
    public function getInstTemplateFormlar(){
        return $this->instTemplate['editFormular'];
    }
    public function getInstTemplateBody(){
        return $this->instTemplate['body'];
    }
    public function getInstTemplateEnterprice(){
        return $this->instTemplate['enterprice'];
    }
    public function getInstTemplateFooter(){
        return $this->instTemplate['footer'];
    }


    /**
     * @param mixed $instTemplate
     */
    public function setInstTemplate($instTemplate)
    {
        $this->instTemplate = $instTemplate;
    }

    public function serInstTemplateHeader($header){
        $this->instTemplate['header'] = $header;
    }
    public function serInstTemplateMainNavigation($mainNavigation){
        $this->instTemplate['mainNavigation'] = $mainNavigation;
    }
    public function serInstTemplateEditFormular($editFormular){
        $this->instTemplate['editFormular'] = $editFormular;
    }
    public function serInstTemplateBody($body){
        $this->instTemplate['body'] = $body;
    }
    public function serInstTemplateEnterprice($enterprise){
        $this->instTemplate['enterprice'] = $enterprise;
    }
    public function serInstTemplateFooter($footer){
        $this->instTemplate['footer'] = $footer;
    }

    function __construct()
    {
        $instrTemplate = [
            'header',
            'mainNavigation',
            'editFormular',
            'body',
            'enterprice',
            'footer',
            'scripts',
        ];
    }

    function loadDefaultPage()
    {
        $instrTemplate = [
            'header'         => readfile($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/header.html'),
            'mainNavigation' => readfile($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/mainNavigation.html'),
            'editFormular'   => readfile($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructorEditFormular.html'),
            'body'           => readfile($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructor.html'),
            'enterprice'     => readfile($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructorShow.html'),
            'footer'         => readfile($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/footer.html'),
            'scripts'        => readfile($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/instructorScripts.html'),
        ];
    }

    function render($instrTemplate, $dbArray)
    {
// switch case, was angezeigt werden soll (Betrieb/Schule/Extern) - z.B. über Request-Parameter
// (die Seite wird ja neu geladen, wenn man auf der Seite einen der Links angeklickt, da kann man dann den Parameter ranhängen.
        $dbEntries = $dbArray; // deine DB-Methode, um die Daten zu holen
        $content = '';
        foreach ($dbEntries as $entry) {

            $recordTemplate = readfile($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/recordDbInstructor.html');
            $search = [
                'prop1'=> '###NAME###',
                'prop2'=> '###VORNAME###',
                'prop3'=> '###ROLE###',
            ];
            $replace = [
                $entry['name'],
                $entry['vorname'],
                $entry['role'],
//                $entry->getProp1(),
//                $entry->getProp2(),
//                $entry->getProp3(),
            ];

            $recordTemplate = str_replace($search, $replace, $recordTemplate);
            $content .= $recordTemplate;
        }

        $this->$instrTemplate->getInstTemplateEnterprice() = str_replace('###CONTENT###', $content, $instrTemplate['enterprise']);
    }
}