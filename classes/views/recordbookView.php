<?php


class recordbookView
{

//    Variablen
    private $recordbookTemplate;



//    Setter und Getter
    /**
     * @return mixed
     */
    public function getRecordbookTemplate()
    {
        return $this->recordbookTemplate;
    }

    /**
     * @param mixed $recordbookTemplate
     */
    public function setRecordbookTemplate($recordbookTemplate)
    {
        $this->recordbookTemplate = $recordbookTemplate;
    }

    public function getRecordbookHeader(){
        return $this->recordbookTemplate['header'];
    }

    public function setRecordbookHeader($header){
        $this->recordbookTemplate['header'] = $header;
    }

    public function getRecordbookNavigation(){
        return $this->recordbookTemplate['mainNavigation'];
    }

    public function setRecordbookNavigation($navigation){
        $this->recordbookTemplate['mainNavigation'] = $navigation;
    }

    public function getRecordbookBody(){
        return $this->recordbookTemplate['body'];
    }

    public function setRecordbookBody($body){
        $this->recordbookTemplate['body'] = $body;
    }


    public function getRecordbookFooter(){
        return $this->recordbookTemplate['footer'];
    }

    public function setRecordbookFooter($footer){
        $this->recordbookTemplate['footer'] = $footer;
    }

    public function getRecordbookScripts(){
        return $this->recordbookTemplate['scripts'];
    }

    public function setRecordbookScripts($script){
        $this->recordbookTemplate['scripts'] = $script;
    }

//    Konstruktor
    function __construct()
    {
        $recordbookTemplate = [
            'header',
            'mainNavigation',
            'body',
            'footer',
            'scripts'
        ];
    }


    function printSide($recordbookTemplate)
    {
        foreach ($recordbookTemplate as $sideContent) {
            foreach ($sideContent as $content) {
                echo $content;
            }
        }
    }


    function loadDefaultPage()
    {
        $this->setRecordbookHeader(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/recordbook/headerRecordbook.html'));
        $this->setRecordbookNavigation(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/recordbook/mainNavigation.html'));
        $this->setRecordbookBody(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/recordbook/.html'));
        $this->setRecordbookFooter(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/recordbook/footer.html'));
        $this->setRecordbookScripts(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/recordbook/.html'));

        $this->printSide($this);
    }

}
