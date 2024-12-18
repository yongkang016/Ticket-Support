<?php

namespace App\Constants;

class WebRouteName
{

    //Login Route
    const string WEB_ROUTE_LOGIN = 'web-route.login.*';
    const string WEB_ROUTE_LOGIN_INDEX = 'web-route.login.index';

    //Dashboard Route
    const string WEB_ROUTE_DASHBOARD = 'web-route.dashboard';

    //User Route
    const string WEB_ROUTE_USER = 'web-route.user.*';
    const string WEB_ROUTE_USER_INDEX = 'web-route.user.index';
    const string WEB_ROUTE_USER_CREATE = 'web-route.user.create';
    const string WEB_ROUTE_USER_STORE = 'web-route.user.store';
    const string WEB_ROUTE_USER_UPDATE = 'web-route.user.update';
    const string WEB_ROUTE_USER_DELETE = 'web-route.user.delete';

    //Company Route
    const string WEB_ROUTE_COMPANY = 'web-route.company.*';
    const string WEB_ROUTE_COMPANY_INDEX = 'web-route.company.index';
    const string WEB_ROUTE_COMPANY_CREATE = 'web-route.company.create';
    const string WEB_ROUTE_COMPANY_STORE = 'web-route.company.store';
    const string WEB_ROUTE_COMPANY_UPDATE = 'web-route.company.update';
    const string WEB_ROUTE_COMPANY_DELETE = 'web-route.company.delete';


    //Register Route
    const string WEB_ROUTE_REGISTER = 'web-route.register.*';
    const string WEB_ROUTE_REGISTER_INDEX = 'wen-route.register.index';

    //Project Route
    const string WEB_ROUTE_PROJECT = 'web-route.project.*';
    const string WEB_ROUTE_PROJECT_INDEX = 'web-route.project.index';
    const string WEB_ROUTE_PROJECT_CREATE = 'web-route.project.create';
    const string WEB_ROUTE_PROJECT_STORE = 'web-route.project.store';
    const string WEB_ROUTE_PROJECT_UPDATE = 'web-route.project.update';
    const string WEB_ROUTE_PROJECT_DELETE = 'web-route.project.delete';



    //Ticket Route
    const string WEB_ROUTE_TICKET = 'web-route.ticket.*';
    const string WEB_ROUTE_TICKET_INDEX = 'web-route.ticket.index';
    const string WEB_ROUTE_TICKET_CREATE = 'web-route.ticket.create';
    const string WEB_ROUTE_TICKET_STORE = 'web-route.ticket.store';
    const string WEB_ROUTE_TICKET_UPDATE = 'web-route.ticket.update';
    const string WEB_ROUTE_TICKET_UPDATE_PROGRESS = 'web-route.ticket.update.progress';

    //Message Route
    const string WEB_ROUTE_TICKET_STORE_MESSAGE = 'web-route.ticket.store.message';
    const string WEB_ROUTE_TICKET_GET_MESSAGE = 'web-route.ticket.chat.message';


}
