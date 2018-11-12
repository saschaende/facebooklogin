<?php

namespace SaschaEnde\Facebooklogin\Controller;

use SaschaEnde\Facebooklogin\Service\FacebookService;
use t3h\t3h;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Domain\Repository\FrontendUserGroupRepository;
use TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\Generic\QueryResult;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class LoginController extends ActionController
{

    /**
     * @var FrontendUserRepository
     */
    protected $frontendUserRepository;

    /**
     * @var FrontendUserGroupRepository
     */
    protected $frontendUserGroupRepository;

    public function initializeAction()
    {
        $this->frontendUserRepository = $this->objectManager->get(FrontendUserRepository::class);
        $this->frontendUserRepository->setDefaultQuerySettings(t3h::Database()->getQuerySettings());

        $this->frontendUserGroupRepository = $this->objectManager->get(FrontendUserGroupRepository::class);
        $this->frontendUserGroupRepository->setDefaultQuerySettings(t3h::Database()->getQuerySettings());
    }

    public function loginAction()
    {

        $fb = new FacebookService();
        $fb->setClientid($this->settings['fb_clientid']);
        $fb->setClientsecret($this->settings['fb_clientsecret']);
        $fb->setRedirecturi(t3h::Uri()->getByPid($GLOBALS['TSFE']->id));


        if (!isset($_GET['code'])) {
            // Redirect to Facebook for authentication
            $this->redirectToUri($fb->getAuthUri());
        } else {
            // Redirected from facebook, auth with code now
            $fb->auth($_GET['code']);

            // get userdata from facebook
            $userdata = $fb->getUserdata();

            /** @var QueryResult $userfromdb */
            $userfromdb = $this->frontendUserRepository->findByEmail($userdata->email);

            // --------------------------------------------------------------------------------
            // Nutzer wurde gefudnen
            // --------------------------------------------------------------------------------

            if ($userfromdb->count() >= 1) {
                /** @var FrontendUser $user */
                $user = $userfromdb->getFirst();

                // Einloggen, da der Nutzer gefunden wurde
                t3h::FrontendUser()->loginUser($user->getUsername());

                // Weiterleitung
                $this->redirectToUri($this->settings['login_redirect']);
            }

            // --------------------------------------------------------------------------------
            // Keine Daten
            // --------------------------------------------------------------------------------
            elseif (!isset($userdata->email) || empty($userdata->email)) {
                // Keine E-Mail Adresse vorhanden? Fehler...
                $this->view->assign('status', 'error');
                // Und hier wird das Template mit der Fehlermeldung angezeigt
                return;
            }

            // --------------------------------------------------------------------------------
            // Email gefunden, aber muss neu angelegt werden
            // --------------------------------------------------------------------------------

            else {
                // Email vorhanden, User existiert nicht, also legen wir ihn an
                $user = new FrontendUser();
                $user->setUsername($userdata->email);
                $user->setEmail($userdata->email);

                // Rollen setzen
                $os = new ObjectStorage();
                $roleIDs = explode(',', $this->settings['role_id']);
                foreach ($roleIDs as $roleID) {
                    $os->attach($this->frontendUserGroupRepository->findByUid($roleID));
                }
                $user->setUsergroup($os);

                // Vorname Nachname
                $user->setFirstName($userdata->first_name);
                $user->setLastName($userdata->last_name);

                // Speicherort für Nutzer
                $user->setPid($this->settings['user_pid']);

                // Passwort generieren
                $password = t3h::Password()->createReadablePassword();
                $user->setPassword(t3h::Password()->getHashedPassword($password));

                // Speichern
                $this->frontendUserRepository->add($user);
                t3h::Database()->persistAll();

                // Einloggen
                $this->view->assign('status', 'success');
                t3h::FrontendUser()->loginUser($user->getUsername());

                // Und hier wird das Template mit der Begrüßungsnachricht angezeigt
            }


        }
    }

}