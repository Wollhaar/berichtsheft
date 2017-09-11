<?php


class loginView
{

    private $loginTemplate;

    /**
     * @return mixed
     */
    public function getLoginTemplate()
    {
        return $this->loginTemplate;
    }

    /**
     * @param mixed $loginTemplate
     */
    public function setLoginTemplate($loginTemplate)
    {
        $this->loginTemplate = $loginTemplate;
    }

    public function getLoginHeader(){
        return $this->loginTemplate['header'];
    }

    public function setLoginHeader($header){
        $this->loginTemplate['header'] = $header;
    }

    public function getLoginNavigation(){
        return $this->loginTemplate[mainNavigation];
    }

    public function setLoginNavigation($navigation){
        $this->loginTemplate['mainNavigation'] = $navigation;
    }

    public function getLoginFooter(){
        return $this->loginTemplate['footer'];
    }

    public function setLoginFooter($footer){
        $this->loginTemplate['footer'] = $footer;
    }

    public function getLoginLog(){
        return $this->loginTemplate['login'];
    }

    public function setLoginLog($login){
        $this->loginTemplate['login'] = $login;
    }

    public function getLoginPassword(){
        return $this->loginTemplate['wrongPassword'];
    }

    public function setLoginPassword($password){
        $this->loginTemplate['wrongPassword'] = $password;
    }


    function __construct()
    {
        $loginTemplate = [
            'header',
            'mainNavigation',
            'login',
            'password',
            'footer'
        ];
    }

    public function loadDefaultPage(){
        $this->setLoginHeader(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/login/headerLogin.html'));
        $this->setLoginNavigation(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/login/mainNavigation.html'));
        $this->setLoginLog(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/login/login.html'));
        $this->setLoginFooter(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/login/footer.html'));

        $this->printSide($this);
    }

    public function render($operator){
        switch ($operator) {
            case 'password': {
                $this->setLoginHeader(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/login/headerLogin.html'));
                $this->setLoginNavigation(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/login/mainNavigation.html'));
                $this->setLoginLog(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/login/login.html'));
                $this->setLoginPassword(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/login/password.html'));

                $this->setLoginFooter(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/login/footer.html'));

                $this->printSide($this);
                break;
            }
            case 'wrongPassword': {
                $this->setLoginHeader(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/login/headerLogin.html'));
                $this->setLoginNavigation(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/login/mainNavigation.html'));
                $this->setLoginLog(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/login/login.html'));
                $this->setLoginPassword(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/login/wrongPassword.html'));

                $this->setLoginFooter(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/login/footer.html'));

                $this->printSide($this);
                break;
            }
            case 'createAccount':{
                $this->setLoginHeader(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/login/headerLogin.html'));
                $this->setLoginNavigation(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/login/mainNavigation.html'));
                $this->setLoginLog(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/templates/partials/login/createAccount.html'));

                $this->printSide($this);
                break;
            }
        }
    }

    function printSide($loginTemplate)
    {
        foreach ($loginTemplate as $sideContent) {
            foreach ($sideContent as $content) {
                echo $content;
            }
        }
    }

}