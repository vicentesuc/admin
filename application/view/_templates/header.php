<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Eventos</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URL; ?>css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo URL; ?>font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="<?php echo URL; ?>css/colorbox.min.css"/>
    <link rel="stylesheet" href="<?php echo URL; ?>css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style"/>
    <link rel="stylesheet" href="<?php echo URL; ?>css/ace-skins.min.css" />
    <link rel="stylesheet" href="<?php echo URL; ?>css/ace-rtl.min.css"/>
    <link rel="stylesheet" href="<?php echo URL; ?>css/jquery.gritter.min.css"/>
    <link rel="stylesheet" href="<?php echo URL; ?>css/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" href="<?php echo URL; ?>css/dropzone.min.css"/>

    <link href="<?php echo URL ?>css/dataTables/datatables.min.css" rel="stylesheet">
    <link href="<?php echo URL ?>css/dataTables/select.dataTables.min.css" rel="stylesheet">
    <script src="<?php echo URL; ?>js/jquery/2.1.4/jquery-2.1.4.min.js"></script>
    <script src="<?php echo URL; ?>js/ace-extra.min.js"></script>
</head>
<body class="no-skin">

<div id="modalIni" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalIni-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="modalIni-body"></div>
        </div>
    </div>
</div>
<div id="navbar" class="navbar navbar-default">
    <script type="text/javascript">
        try {
            ace.settings.check('navbar', 'fixed')
        } catch (e) {
        }
    </script>

    <div class="navbar-container" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>
        </button>

        <div class="navbar-header pull-left">
            <a href="#" class="navbar-brand">
                <small>
                    Eventos
                </small>
            </a>
        </div>

        <div class="navbar-buttons navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">

                <li class="purple">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="ace-icon fa fa-bell icon-animated-bell"></i>
                        <span class="badge badge-important">8</span>
                    </a>

                    <ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
                        <li class="dropdown-header">
                            <i class="ace-icon fa fa-exclamation-triangle"></i>
                            1 Notifications
                        </li>
                        <li class="dropdown-content">
                            <ul class="dropdown-menu dropdown-navbar navbar-pink">
                                <li>
                                    <a href="#">
                                        <div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-pink fa fa-comment"></i>
														New Comments
													</span>
                                            <span class="pull-right badge badge-info">+12</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown-footer">
                            <a href="#">
                                ver todas las notificaciones
                                <i class="ace-icon fa fa-arrow-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="light-blue">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <img class="nav-user-photo" src="<?php echo URL ?>/avatars/user.jpg" alt="Jason's Photo"/>
                        <span class="user-info">
									<small>Welcome,</small>
									Jason
								</span>
                        <i class="ace-icon fa fa-caret-down"></i>
                    </a>
                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li>
                            <a href="<?php echo URL ?>login/logout">
                                <i class="ace-icon fa fa-power-off"></i>
                                Salir
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div><!-- /.navbar-container -->
</div>

<div class="main-container" id="main-container">

    <script type="text/javascript">
        try {
            ace.settings.check('main-container', 'fixed')
        } catch (e) {
        }
    </script>

    <div id="sidebar" class="sidebar                  responsive">
        <script type="text/javascript">
            try {
                ace.settings.check('sidebar', 'fixed')
            } catch (e) {
            }
        </script>

        <div class="sidebar-shortcuts" id="sidebar-shortcuts">
            <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
                <button class="btn btn-success">
                    <i class="ace-icon fa fa-users"></i>
                </button>

                <button class="btn btn-info">
                    <i class="ace-icon fa fa-bell"></i>
                </button>

                <button class="btn btn-warning">
                    <i class="ace-icon fa fa-building"></i>
                </button>

                <button class="btn btn-danger">
                    <i class="ace-icon fa fa-user-circle-o"></i>
                </button>
            </div>

            <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                <span class="btn btn-success"></span>

                <span class="btn btn-info"></span>

                <span class="btn btn-warning"></span>

                <span class="btn btn-danger"></span>
            </div>
        </div><!-- /.sidebar-shortcuts -->

        <ul class="nav nav-list">
            <li class="">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-bell"></i>
                    <span class="menu-text"> Eventos </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    <li class="">
                        <a href="<?php echo URL ?>events">
                            <i class="menu-icon fa fa-list"></i> Lista de Eventos
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="">
                        <a href="<?php echo URL ?>events">
                            <i class="menu-icon fa fa-calendar"></i> Calendario
                        </a>
                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-users"></i>
                    <span class="menu-text"> Usuarios </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    <li class="">
                        <a href="<?php echo URL ?>user">
                            <i class="menu-icon fa fa-user"></i> Lista</a>
                        <b class="arrow"></b>
                    </li>
                    <li class="">
                        <a href="<?php echo URL ?>user/create">
                            <i class="menu-icon fa fa-user-plus "></i> Crear Nuevo</a>
                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>
            <li>
                <a href="<?php echo URL ?>franchise">
                    <i class="menu-icon fa fa-building"></i>
                    <span class="menu-text"> Franquicias </span>
                </a>

                <b class="arrow"></b>
            </li>
            <li class="">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-user-circle-o"></i>
                    <span class="menu-text"> Speakers </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    <li class="">
                        <a href="<?php echo URL ?>speaker">
                            <i class="menu-icon fa fa-user-circle-o"></i> Registrados</a>
                        <b class="arrow"></b>
                    </li>
                    <li class="">
                        <a href="<?php echo URL ?>user/create">
                            <i class="menu-icon fa fa-plus "></i>Nuevo Speaker</a>
                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>


        </ul><!-- /.nav-list -->

        <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
            <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left"
               data-icon2="ace-icon fa fa-angle-double-right"></i>
        </div>

        <script type="text/javascript">
            try {
                ace.settings.check('sidebar', 'collapsed')
            } catch (e) {
            }
        </script>
    </div>

    <div class="main-content">
        <div class="main-content-inner">
            <input id="gritter-light" checked="" type="checkbox" class="ace ace-switch ace-switch-5"/>
