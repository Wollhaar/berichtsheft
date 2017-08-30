<?php

class dashboardView
{
    private $instTemplate;

    private $last_record;

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

    public function getInstTemplateBody()
    {
        return $this->instTemplate['body'];
    }

    public function getInstTemplateFooter()
    {
        return $this->instTemplate['footer'];
    }

    public function getLastRecord()
    {
        return $this->last_record;
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

    public function setInstTemplateBody($body)
    {
        $this->instTemplate['body'] = $body;
    }

    public function setInstTemplateFooter($footer)
    {
        $this->instTemplate['footer'] = $footer;
    }

    public function setInstTemplateScripts($scripts)
    {
        $this->instTemplate['scripts'] = $scripts;
    }

    public function setLastRecord($record)
    {
        $this->last_record = $record;
    }

    public function __construct($record)
    {
        $this->setLastRecord($record);

        $instTemplate = [
            'header',
            'mainNavigation',
            'body',
            'footer',
            'scripts',
        ];
    }

    public function loadDefaultPage()
    {
        $this->setInstTemplateHeader(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/recordbook2.0/resources/partials/dashboard/header.html'));
        $this->setInstTemplateMainNavigation(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/recordbook2.0/resources/partials/mainNavigation.html'));
        $this->setInstTemplateBody(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/recordbook2.0/resources/partials/dashboard/dashboard.html'));
        $this->setInstTemplateFooter(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/recordbook2.0/resources/partials/footer.html'));
//        $this->setInstTemplateScripts(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/recordbook2.0/resources/partials/dashboard/Scripts.html'));

        $this->printSide($this->instTemplate);
    }

    public function printSide($instrTemplate)
    {
        foreach ($instrTemplate as $sideContent) {
            foreach ($sideContent as $content) {
                echo $content;
            }
        }
    }


}