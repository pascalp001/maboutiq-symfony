<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appProdUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        if (0 === strpos($pathinfo, '/log')) {
            if (0 === strpos($pathinfo, '/login')) {
                // fos_user_security_login
                if ($pathinfo === '/login') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_fos_user_security_login;
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::loginAction',  '_route' => 'fos_user_security_login',);
                }
                not_fos_user_security_login:

                // fos_user_security_check
                if ($pathinfo === '/login_check') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_fos_user_security_check;
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::checkAction',  '_route' => 'fos_user_security_check',);
                }
                not_fos_user_security_check:

            }

            // fos_user_security_logout
            if ($pathinfo === '/logout') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_security_logout;
                }

                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::logoutAction',  '_route' => 'fos_user_security_logout',);
            }
            not_fos_user_security_logout:

        }

        if (0 === strpos($pathinfo, '/profile')) {
            // fos_user_profile_show
            if (rtrim($pathinfo, '/') === '/profile') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_profile_show;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'fos_user_profile_show');
                }

                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ProfileController::showAction',  '_route' => 'fos_user_profile_show',);
            }
            not_fos_user_profile_show:

            // fos_user_profile_edit
            if ($pathinfo === '/profile/edit') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_fos_user_profile_edit;
                }

                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ProfileController::editAction',  '_route' => 'fos_user_profile_edit',);
            }
            not_fos_user_profile_edit:

        }

        if (0 === strpos($pathinfo, '/re')) {
            if (0 === strpos($pathinfo, '/register')) {
                // fos_user_registration_register
                if (rtrim($pathinfo, '/') === '/register') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_fos_user_registration_register;
                    }

                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'fos_user_registration_register');
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::registerAction',  '_route' => 'fos_user_registration_register',);
                }
                not_fos_user_registration_register:

                if (0 === strpos($pathinfo, '/register/c')) {
                    // fos_user_registration_check_email
                    if ($pathinfo === '/register/check-email') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_fos_user_registration_check_email;
                        }

                        return array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::checkEmailAction',  '_route' => 'fos_user_registration_check_email',);
                    }
                    not_fos_user_registration_check_email:

                    if (0 === strpos($pathinfo, '/register/confirm')) {
                        // fos_user_registration_confirm
                        if (preg_match('#^/register/confirm/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_fos_user_registration_confirm;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_registration_confirm')), array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::confirmAction',));
                        }
                        not_fos_user_registration_confirm:

                        // fos_user_registration_confirmed
                        if ($pathinfo === '/register/confirmed') {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_fos_user_registration_confirmed;
                            }

                            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::confirmedAction',  '_route' => 'fos_user_registration_confirmed',);
                        }
                        not_fos_user_registration_confirmed:

                    }

                }

            }

            if (0 === strpos($pathinfo, '/resetting')) {
                // fos_user_resetting_request
                if ($pathinfo === '/resetting/request') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_fos_user_resetting_request;
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::requestAction',  '_route' => 'fos_user_resetting_request',);
                }
                not_fos_user_resetting_request:

                // fos_user_resetting_send_email
                if ($pathinfo === '/resetting/send-email') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_fos_user_resetting_send_email;
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::sendEmailAction',  '_route' => 'fos_user_resetting_send_email',);
                }
                not_fos_user_resetting_send_email:

                // fos_user_resetting_check_email
                if ($pathinfo === '/resetting/check-email') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_fos_user_resetting_check_email;
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::checkEmailAction',  '_route' => 'fos_user_resetting_check_email',);
                }
                not_fos_user_resetting_check_email:

                // fos_user_resetting_reset
                if (0 === strpos($pathinfo, '/resetting/reset') && preg_match('#^/resetting/reset/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_fos_user_resetting_reset;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_resetting_reset')), array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::resetAction',));
                }
                not_fos_user_resetting_reset:

            }

        }

        // fos_user_change_password
        if ($pathinfo === '/profile/change-password') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_fos_user_change_password;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ChangePasswordController::changePasswordAction',  '_route' => 'fos_user_change_password',);
        }
        not_fos_user_change_password:

        if (0 === strpos($pathinfo, '/a')) {
            if (0 === strpos($pathinfo, '/adresse')) {
                // adresse
                if (rtrim($pathinfo, '/') === '/adresse') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_adresse;
                    }

                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'adresse');
                    }

                    return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\AdresseController::indexAction',  '_route' => 'adresse',);
                }
                not_adresse:

                // adresse_create
                if ($pathinfo === '/adresse/') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_adresse_create;
                    }

                    return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\AdresseController::createAction',  '_route' => 'adresse_create',);
                }
                not_adresse_create:

                // adresse_new
                if ($pathinfo === '/adresse/new') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_adresse_new;
                    }

                    return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\AdresseController::newAction',  '_route' => 'adresse_new',);
                }
                not_adresse_new:

                // adresse_show
                if (preg_match('#^/adresse/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_adresse_show;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'adresse_show')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\AdresseController::showAction',));
                }
                not_adresse_show:

                // adresse_edit
                if (preg_match('#^/adresse/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_adresse_edit;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'adresse_edit')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\AdresseController::editAction',));
                }
                not_adresse_edit:

                // adresse_update
                if (preg_match('#^/adresse/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'PUT') {
                        $allow[] = 'PUT';
                        goto not_adresse_update;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'adresse_update')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\AdresseController::updateAction',));
                }
                not_adresse_update:

                // adresse_delete
                if (preg_match('#^/adresse/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'DELETE') {
                        $allow[] = 'DELETE';
                        goto not_adresse_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'adresse_delete')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\AdresseController::deleteAction',));
                }
                not_adresse_delete:

            }

            if (0 === strpos($pathinfo, '/avis')) {
                // avis
                if (rtrim($pathinfo, '/') === '/avis') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_avis;
                    }

                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'avis');
                    }

                    return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\AvisController::indexAction',  '_route' => 'avis',);
                }
                not_avis:

                // avis_create
                if ($pathinfo === '/avis/') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_avis_create;
                    }

                    return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\AvisController::createAction',  '_route' => 'avis_create',);
                }
                not_avis_create:

                // avis_new
                if ($pathinfo === '/avis/new') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_avis_new;
                    }

                    return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\AvisController::newAction',  '_route' => 'avis_new',);
                }
                not_avis_new:

                // avis_show
                if (preg_match('#^/avis/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_avis_show;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'avis_show')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\AvisController::showAction',));
                }
                not_avis_show:

                // avis_edit
                if (preg_match('#^/avis/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_avis_edit;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'avis_edit')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\AvisController::editAction',));
                }
                not_avis_edit:

                // avis_update
                if (preg_match('#^/avis/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'PUT') {
                        $allow[] = 'PUT';
                        goto not_avis_update;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'avis_update')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\AvisController::updateAction',));
                }
                not_avis_update:

                // avis_delete
                if (preg_match('#^/avis/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'DELETE') {
                        $allow[] = 'DELETE';
                        goto not_avis_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'avis_delete')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\AvisController::deleteAction',));
                }
                not_avis_delete:

            }

        }

        if (0 === strpos($pathinfo, '/c')) {
            if (0 === strpos($pathinfo, '/categorie')) {
                // categorie
                if (rtrim($pathinfo, '/') === '/categorie') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_categorie;
                    }

                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'categorie');
                    }

                    return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\CategorieController::indexAction',  '_route' => 'categorie',);
                }
                not_categorie:

                // categorie_create
                if ($pathinfo === '/categorie/') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_categorie_create;
                    }

                    return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\CategorieController::createAction',  '_route' => 'categorie_create',);
                }
                not_categorie_create:

                // categorie_new
                if ($pathinfo === '/categorie/new') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_categorie_new;
                    }

                    return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\CategorieController::newAction',  '_route' => 'categorie_new',);
                }
                not_categorie_new:

                // categorie_show
                if (preg_match('#^/categorie/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_categorie_show;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'categorie_show')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\CategorieController::showAction',));
                }
                not_categorie_show:

                // categorie_edit
                if (preg_match('#^/categorie/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_categorie_edit;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'categorie_edit')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\CategorieController::editAction',));
                }
                not_categorie_edit:

                // categorie_update
                if (preg_match('#^/categorie/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'PUT') {
                        $allow[] = 'PUT';
                        goto not_categorie_update;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'categorie_update')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\CategorieController::updateAction',));
                }
                not_categorie_update:

                // categorie_delete
                if (preg_match('#^/categorie/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'DELETE') {
                        $allow[] = 'DELETE';
                        goto not_categorie_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'categorie_delete')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\CategorieController::deleteAction',));
                }
                not_categorie_delete:

            }

            if (0 === strpos($pathinfo, '/connexion')) {
                // connexion
                if (rtrim($pathinfo, '/') === '/connexion') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_connexion;
                    }

                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'connexion');
                    }

                    return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\ConnexionController::indexAction',  '_route' => 'connexion',);
                }
                not_connexion:

                // connexion_create
                if ($pathinfo === '/connexion/') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_connexion_create;
                    }

                    return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\ConnexionController::createAction',  '_route' => 'connexion_create',);
                }
                not_connexion_create:

                // connexion_new
                if ($pathinfo === '/connexion/new') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_connexion_new;
                    }

                    return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\ConnexionController::newAction',  '_route' => 'connexion_new',);
                }
                not_connexion_new:

                // connexion_show
                if (preg_match('#^/connexion/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_connexion_show;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'connexion_show')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\ConnexionController::showAction',));
                }
                not_connexion_show:

                // connexion_edit
                if (preg_match('#^/connexion/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_connexion_edit;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'connexion_edit')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\ConnexionController::editAction',));
                }
                not_connexion_edit:

                // connexion_update
                if (preg_match('#^/connexion/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'PUT') {
                        $allow[] = 'PUT';
                        goto not_connexion_update;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'connexion_update')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\ConnexionController::updateAction',));
                }
                not_connexion_update:

                // connexion_delete
                if (preg_match('#^/connexion/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'DELETE') {
                        $allow[] = 'DELETE';
                        goto not_connexion_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'connexion_delete')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\ConnexionController::deleteAction',));
                }
                not_connexion_delete:

            }

        }

        // gr7dev_appliecom_default_somme
        if (0 === strpos($pathinfo, '/somme') && preg_match('#^/somme/(?P<a>[^/]++)/(?P<b>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'gr7dev_appliecom_default_somme')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\DefaultController::sommeAction',));
        }

        if (0 === strpos($pathinfo, '/detail')) {
            // detail
            if (rtrim($pathinfo, '/') === '/detail') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_detail;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'detail');
                }

                return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\DetailController::indexAction',  '_route' => 'detail',);
            }
            not_detail:

            // detail_create
            if ($pathinfo === '/detail/') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_detail_create;
                }

                return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\DetailController::createAction',  '_route' => 'detail_create',);
            }
            not_detail_create:

            // detail_new
            if ($pathinfo === '/detail/new') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_detail_new;
                }

                return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\DetailController::newAction',  '_route' => 'detail_new',);
            }
            not_detail_new:

            // detail_show
            if (preg_match('#^/detail/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_detail_show;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'detail_show')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\DetailController::showAction',));
            }
            not_detail_show:

            // detail_edit
            if (preg_match('#^/detail/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_detail_edit;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'detail_edit')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\DetailController::editAction',));
            }
            not_detail_edit:

            // detail_update
            if (preg_match('#^/detail/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'PUT') {
                    $allow[] = 'PUT';
                    goto not_detail_update;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'detail_update')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\DetailController::updateAction',));
            }
            not_detail_update:

            // detail_delete
            if (preg_match('#^/detail/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'DELETE') {
                    $allow[] = 'DELETE';
                    goto not_detail_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'detail_delete')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\DetailController::deleteAction',));
            }
            not_detail_delete:

        }

        if (0 === strpos($pathinfo, '/finalisation')) {
            // finalisation
            if (rtrim($pathinfo, '/') === '/finalisation') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_finalisation;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'finalisation');
                }

                return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\FinalisationController::indexAction',  '_route' => 'finalisation',);
            }
            not_finalisation:

            // finalisation_create
            if ($pathinfo === '/finalisation/') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_finalisation_create;
                }

                return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\FinalisationController::createAction',  '_route' => 'finalisation_create',);
            }
            not_finalisation_create:

            // finalisation_new
            if ($pathinfo === '/finalisation/new') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_finalisation_new;
                }

                return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\FinalisationController::newAction',  '_route' => 'finalisation_new',);
            }
            not_finalisation_new:

            // finalisation_show
            if (preg_match('#^/finalisation/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_finalisation_show;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'finalisation_show')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\FinalisationController::showAction',));
            }
            not_finalisation_show:

            // finalisation_edit
            if (preg_match('#^/finalisation/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_finalisation_edit;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'finalisation_edit')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\FinalisationController::editAction',));
            }
            not_finalisation_edit:

            // finalisation_update
            if (preg_match('#^/finalisation/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'PUT') {
                    $allow[] = 'PUT';
                    goto not_finalisation_update;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'finalisation_update')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\FinalisationController::updateAction',));
            }
            not_finalisation_update:

            // finalisation_delete
            if (preg_match('#^/finalisation/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'DELETE') {
                    $allow[] = 'DELETE';
                    goto not_finalisation_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'finalisation_delete')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\FinalisationController::deleteAction',));
            }
            not_finalisation_delete:

        }

        if (0 === strpos($pathinfo, '/inscrit')) {
            // inscrit
            if (rtrim($pathinfo, '/') === '/inscrit') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_inscrit;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'inscrit');
                }

                return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\InscritController::indexAction',  '_route' => 'inscrit',);
            }
            not_inscrit:

            // inscrit_create
            if ($pathinfo === '/inscrit/') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_inscrit_create;
                }

                return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\InscritController::createAction',  '_route' => 'inscrit_create',);
            }
            not_inscrit_create:

            // inscrit_new
            if ($pathinfo === '/inscrit/new') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_inscrit_new;
                }

                return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\InscritController::newAction',  '_route' => 'inscrit_new',);
            }
            not_inscrit_new:

            // inscrit_show
            if (preg_match('#^/inscrit/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_inscrit_show;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'inscrit_show')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\InscritController::showAction',));
            }
            not_inscrit_show:

            // inscrit_edit
            if (preg_match('#^/inscrit/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_inscrit_edit;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'inscrit_edit')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\InscritController::editAction',));
            }
            not_inscrit_edit:

            // inscrit_update
            if (preg_match('#^/inscrit/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'PUT') {
                    $allow[] = 'PUT';
                    goto not_inscrit_update;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'inscrit_update')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\InscritController::updateAction',));
            }
            not_inscrit_update:

            // inscrit_delete
            if (preg_match('#^/inscrit/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'DELETE') {
                    $allow[] = 'DELETE';
                    goto not_inscrit_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'inscrit_delete')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\InscritController::deleteAction',));
            }
            not_inscrit_delete:

        }

        if (0 === strpos($pathinfo, '/lignecomde')) {
            // lignecomde
            if (rtrim($pathinfo, '/') === '/lignecomde') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_lignecomde;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'lignecomde');
                }

                return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\LigneComdeController::indexAction',  '_route' => 'lignecomde',);
            }
            not_lignecomde:

            // lignecomde_create
            if ($pathinfo === '/lignecomde/') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_lignecomde_create;
                }

                return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\LigneComdeController::createAction',  '_route' => 'lignecomde_create',);
            }
            not_lignecomde_create:

            // lignecomde_new
            if ($pathinfo === '/lignecomde/new') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_lignecomde_new;
                }

                return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\LigneComdeController::newAction',  '_route' => 'lignecomde_new',);
            }
            not_lignecomde_new:

            // lignecomde_show
            if (preg_match('#^/lignecomde/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_lignecomde_show;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'lignecomde_show')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\LigneComdeController::showAction',));
            }
            not_lignecomde_show:

            // lignecomde_edit
            if (preg_match('#^/lignecomde/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_lignecomde_edit;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'lignecomde_edit')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\LigneComdeController::editAction',));
            }
            not_lignecomde_edit:

            // lignecomde_update
            if (preg_match('#^/lignecomde/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'PUT') {
                    $allow[] = 'PUT';
                    goto not_lignecomde_update;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'lignecomde_update')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\LigneComdeController::updateAction',));
            }
            not_lignecomde_update:

            // lignecomde_delete
            if (preg_match('#^/lignecomde/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'DELETE') {
                    $allow[] = 'DELETE';
                    goto not_lignecomde_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'lignecomde_delete')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\LigneComdeController::deleteAction',));
            }
            not_lignecomde_delete:

        }

        if (0 === strpos($pathinfo, '/p')) {
            if (0 === strpos($pathinfo, '/panier')) {
                // panier
                if (rtrim($pathinfo, '/') === '/panier') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_panier;
                    }

                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'panier');
                    }

                    return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\PanierController::indexAction',  '_route' => 'panier',);
                }
                not_panier:

                // panier_create
                if ($pathinfo === '/panier/') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_panier_create;
                    }

                    return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\PanierController::createAction',  '_route' => 'panier_create',);
                }
                not_panier_create:

                // panier_new
                if ($pathinfo === '/panier/new') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_panier_new;
                    }

                    return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\PanierController::newAction',  '_route' => 'panier_new',);
                }
                not_panier_new:

                // panier_show
                if (preg_match('#^/panier/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_panier_show;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'panier_show')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\PanierController::showAction',));
                }
                not_panier_show:

                // panier_edit
                if (preg_match('#^/panier/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_panier_edit;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'panier_edit')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\PanierController::editAction',));
                }
                not_panier_edit:

                // panier_update
                if (preg_match('#^/panier/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'PUT') {
                        $allow[] = 'PUT';
                        goto not_panier_update;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'panier_update')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\PanierController::updateAction',));
                }
                not_panier_update:

                // panier_delete
                if (preg_match('#^/panier/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'DELETE') {
                        $allow[] = 'DELETE';
                        goto not_panier_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'panier_delete')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\PanierController::deleteAction',));
                }
                not_panier_delete:

            }

            if (0 === strpos($pathinfo, '/pr')) {
                if (0 === strpos($pathinfo, '/prixproduit')) {
                    // prixproduit
                    if (rtrim($pathinfo, '/') === '/prixproduit') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_prixproduit;
                        }

                        if (substr($pathinfo, -1) !== '/') {
                            return $this->redirect($pathinfo.'/', 'prixproduit');
                        }

                        return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\PrixProduitController::indexAction',  '_route' => 'prixproduit',);
                    }
                    not_prixproduit:

                    // prixproduit_create
                    if ($pathinfo === '/prixproduit/') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_prixproduit_create;
                        }

                        return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\PrixProduitController::createAction',  '_route' => 'prixproduit_create',);
                    }
                    not_prixproduit_create:

                    // prixproduit_new
                    if ($pathinfo === '/prixproduit/new') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_prixproduit_new;
                        }

                        return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\PrixProduitController::newAction',  '_route' => 'prixproduit_new',);
                    }
                    not_prixproduit_new:

                    // prixproduit_show
                    if (preg_match('#^/prixproduit/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_prixproduit_show;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'prixproduit_show')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\PrixProduitController::showAction',));
                    }
                    not_prixproduit_show:

                    // prixproduit_edit
                    if (preg_match('#^/prixproduit/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_prixproduit_edit;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'prixproduit_edit')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\PrixProduitController::editAction',));
                    }
                    not_prixproduit_edit:

                    // prixproduit_update
                    if (preg_match('#^/prixproduit/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'PUT') {
                            $allow[] = 'PUT';
                            goto not_prixproduit_update;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'prixproduit_update')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\PrixProduitController::updateAction',));
                    }
                    not_prixproduit_update:

                    // prixproduit_delete
                    if (preg_match('#^/prixproduit/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'DELETE') {
                            $allow[] = 'DELETE';
                            goto not_prixproduit_delete;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'prixproduit_delete')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\PrixProduitController::deleteAction',));
                    }
                    not_prixproduit_delete:

                }

                if (0 === strpos($pathinfo, '/pro')) {
                    if (0 === strpos($pathinfo, '/produit')) {
                        // produit
                        if (rtrim($pathinfo, '/') === '/produit') {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_produit;
                            }

                            if (substr($pathinfo, -1) !== '/') {
                                return $this->redirect($pathinfo.'/', 'produit');
                            }

                            return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\ProduitController::indexAction',  '_route' => 'produit',);
                        }
                        not_produit:

                        // produit_create
                        if ($pathinfo === '/produit/') {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_produit_create;
                            }

                            return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\ProduitController::createAction',  '_route' => 'produit_create',);
                        }
                        not_produit_create:

                        // produit_new
                        if ($pathinfo === '/produit/new') {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_produit_new;
                            }

                            return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\ProduitController::newAction',  '_route' => 'produit_new',);
                        }
                        not_produit_new:

                        // produit_show
                        if (preg_match('#^/produit/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_produit_show;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'produit_show')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\ProduitController::showAction',));
                        }
                        not_produit_show:

                        // produit_edit
                        if (preg_match('#^/produit/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_produit_edit;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'produit_edit')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\ProduitController::editAction',));
                        }
                        not_produit_edit:

                        // produit_update
                        if (preg_match('#^/produit/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'PUT') {
                                $allow[] = 'PUT';
                                goto not_produit_update;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'produit_update')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\ProduitController::updateAction',));
                        }
                        not_produit_update:

                        // produit_delete
                        if (preg_match('#^/produit/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'DELETE') {
                                $allow[] = 'DELETE';
                                goto not_produit_delete;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'produit_delete')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\ProduitController::deleteAction',));
                        }
                        not_produit_delete:

                    }

                    if (0 === strpos($pathinfo, '/promo')) {
                        if (0 === strpos($pathinfo, '/promocmde')) {
                            // promocmde
                            if (rtrim($pathinfo, '/') === '/promocmde') {
                                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                    $allow = array_merge($allow, array('GET', 'HEAD'));
                                    goto not_promocmde;
                                }

                                if (substr($pathinfo, -1) !== '/') {
                                    return $this->redirect($pathinfo.'/', 'promocmde');
                                }

                                return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\PromoCmdeController::indexAction',  '_route' => 'promocmde',);
                            }
                            not_promocmde:

                            // promocmde_create
                            if ($pathinfo === '/promocmde/') {
                                if ($this->context->getMethod() != 'POST') {
                                    $allow[] = 'POST';
                                    goto not_promocmde_create;
                                }

                                return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\PromoCmdeController::createAction',  '_route' => 'promocmde_create',);
                            }
                            not_promocmde_create:

                            // promocmde_new
                            if ($pathinfo === '/promocmde/new') {
                                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                    $allow = array_merge($allow, array('GET', 'HEAD'));
                                    goto not_promocmde_new;
                                }

                                return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\PromoCmdeController::newAction',  '_route' => 'promocmde_new',);
                            }
                            not_promocmde_new:

                            // promocmde_show
                            if (preg_match('#^/promocmde/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                    $allow = array_merge($allow, array('GET', 'HEAD'));
                                    goto not_promocmde_show;
                                }

                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'promocmde_show')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\PromoCmdeController::showAction',));
                            }
                            not_promocmde_show:

                            // promocmde_edit
                            if (preg_match('#^/promocmde/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                    $allow = array_merge($allow, array('GET', 'HEAD'));
                                    goto not_promocmde_edit;
                                }

                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'promocmde_edit')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\PromoCmdeController::editAction',));
                            }
                            not_promocmde_edit:

                            // promocmde_update
                            if (preg_match('#^/promocmde/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                                if ($this->context->getMethod() != 'PUT') {
                                    $allow[] = 'PUT';
                                    goto not_promocmde_update;
                                }

                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'promocmde_update')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\PromoCmdeController::updateAction',));
                            }
                            not_promocmde_update:

                            // promocmde_delete
                            if (preg_match('#^/promocmde/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                                if ($this->context->getMethod() != 'DELETE') {
                                    $allow[] = 'DELETE';
                                    goto not_promocmde_delete;
                                }

                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'promocmde_delete')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\PromoCmdeController::deleteAction',));
                            }
                            not_promocmde_delete:

                        }

                        if (0 === strpos($pathinfo, '/promoproduit')) {
                            // promoproduit
                            if (rtrim($pathinfo, '/') === '/promoproduit') {
                                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                    $allow = array_merge($allow, array('GET', 'HEAD'));
                                    goto not_promoproduit;
                                }

                                if (substr($pathinfo, -1) !== '/') {
                                    return $this->redirect($pathinfo.'/', 'promoproduit');
                                }

                                return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\PromoProduitController::indexAction',  '_route' => 'promoproduit',);
                            }
                            not_promoproduit:

                            // promoproduit_create
                            if ($pathinfo === '/promoproduit/') {
                                if ($this->context->getMethod() != 'POST') {
                                    $allow[] = 'POST';
                                    goto not_promoproduit_create;
                                }

                                return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\PromoProduitController::createAction',  '_route' => 'promoproduit_create',);
                            }
                            not_promoproduit_create:

                            // promoproduit_new
                            if ($pathinfo === '/promoproduit/new') {
                                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                    $allow = array_merge($allow, array('GET', 'HEAD'));
                                    goto not_promoproduit_new;
                                }

                                return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\PromoProduitController::newAction',  '_route' => 'promoproduit_new',);
                            }
                            not_promoproduit_new:

                            // promoproduit_show
                            if (preg_match('#^/promoproduit/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                    $allow = array_merge($allow, array('GET', 'HEAD'));
                                    goto not_promoproduit_show;
                                }

                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'promoproduit_show')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\PromoProduitController::showAction',));
                            }
                            not_promoproduit_show:

                            // promoproduit_edit
                            if (preg_match('#^/promoproduit/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                    $allow = array_merge($allow, array('GET', 'HEAD'));
                                    goto not_promoproduit_edit;
                                }

                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'promoproduit_edit')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\PromoProduitController::editAction',));
                            }
                            not_promoproduit_edit:

                            // promoproduit_update
                            if (preg_match('#^/promoproduit/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                                if ($this->context->getMethod() != 'PUT') {
                                    $allow[] = 'PUT';
                                    goto not_promoproduit_update;
                                }

                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'promoproduit_update')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\PromoProduitController::updateAction',));
                            }
                            not_promoproduit_update:

                            // promoproduit_delete
                            if (preg_match('#^/promoproduit/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                                if ($this->context->getMethod() != 'DELETE') {
                                    $allow[] = 'DELETE';
                                    goto not_promoproduit_delete;
                                }

                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'promoproduit_delete')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\PromoProduitController::deleteAction',));
                            }
                            not_promoproduit_delete:

                        }

                    }

                }

            }

        }

        if (0 === strpos($pathinfo, '/qualif')) {
            // qualif
            if (rtrim($pathinfo, '/') === '/qualif') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_qualif;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'qualif');
                }

                return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\QualifController::indexAction',  '_route' => 'qualif',);
            }
            not_qualif:

            // qualif_create
            if ($pathinfo === '/qualif/') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_qualif_create;
                }

                return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\QualifController::createAction',  '_route' => 'qualif_create',);
            }
            not_qualif_create:

            // qualif_new
            if ($pathinfo === '/qualif/new') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_qualif_new;
                }

                return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\QualifController::newAction',  '_route' => 'qualif_new',);
            }
            not_qualif_new:

            // qualif_show
            if (preg_match('#^/qualif/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_qualif_show;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'qualif_show')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\QualifController::showAction',));
            }
            not_qualif_show:

            // qualif_edit
            if (preg_match('#^/qualif/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_qualif_edit;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'qualif_edit')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\QualifController::editAction',));
            }
            not_qualif_edit:

            // qualif_update
            if (preg_match('#^/qualif/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'PUT') {
                    $allow[] = 'PUT';
                    goto not_qualif_update;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'qualif_update')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\QualifController::updateAction',));
            }
            not_qualif_update:

            // qualif_delete
            if (preg_match('#^/qualif/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'DELETE') {
                    $allow[] = 'DELETE';
                    goto not_qualif_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'qualif_delete')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\QualifController::deleteAction',));
            }
            not_qualif_delete:

        }

        if (0 === strpos($pathinfo, '/taille')) {
            // taille
            if (rtrim($pathinfo, '/') === '/taille') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_taille;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'taille');
                }

                return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\TailleController::indexAction',  '_route' => 'taille',);
            }
            not_taille:

            // taille_create
            if ($pathinfo === '/taille/') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_taille_create;
                }

                return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\TailleController::createAction',  '_route' => 'taille_create',);
            }
            not_taille_create:

            // taille_new
            if ($pathinfo === '/taille/new') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_taille_new;
                }

                return array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\TailleController::newAction',  '_route' => 'taille_new',);
            }
            not_taille_new:

            // taille_show
            if (preg_match('#^/taille/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_taille_show;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'taille_show')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\TailleController::showAction',));
            }
            not_taille_show:

            // taille_edit
            if (preg_match('#^/taille/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_taille_edit;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'taille_edit')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\TailleController::editAction',));
            }
            not_taille_edit:

            // taille_update
            if (preg_match('#^/taille/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'PUT') {
                    $allow[] = 'PUT';
                    goto not_taille_update;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'taille_update')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\TailleController::updateAction',));
            }
            not_taille_update:

            // taille_delete
            if (preg_match('#^/taille/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'DELETE') {
                    $allow[] = 'DELETE';
                    goto not_taille_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'taille_delete')), array (  '_controller' => 'GR7dev\\appliEComBundle\\Controller\\TailleController::deleteAction',));
            }
            not_taille_delete:

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
