<?php

namespace App\Constants;

class Permission
{
    //ADMIN manage user CRUD
    const string GROUP_USER = 'group.user';
    const string USER_LIST = 'user.list';
    const string USER_VIEW = 'user.view';
    const string USER_CREATE = 'user.create';
    const string USER_UPDATE = 'user.update';
    const string USER_DELETE = 'user.delete';

    //ADMIN manage company CRUD
    const string GROUP_COMPANY = 'group.company';
    const string COMPANY_LIST = 'company.list';
    const string COMPANY_VIEW = 'company.view';
    const string COMPANY_CREATE = 'company.create';
    const string COMPANY_UPDATE = 'company.update';
    const string COMPANY_DELETE = 'company.delete';

    //ADMIN manage project CRUD
    const string GROUP_PROJECT = 'group.project';
    const string PROJECT_LIST = 'project.list';
    const string PROJECT_VIEW = 'project.view';
    const string PROJECT_CREATE = 'project.create';
    const string PROJECT_UPDATE = 'project.update';
    const string PROJECT_DELETE = 'project.delete';

    //CLIENT manage Ticket C
    //ADMIN manage Ticket CRUD
    const string GROUP_TICKET = 'group.ticket';
    const string TICKET_LIST = 'ticket.list';
    const string TICKET_VIEW = 'ticket.view';
    const string TICKET_CREATE = 'ticket.create';
    const string TICKET_UPDATE = 'ticket.update';
    const string TICKET_DELETE = 'ticket.delete';

    //STAFF ACCEPT TASK
    const string TICKET_ACCEPT_TASK = 'ticket.accept.task';

    const string TICKET_UPDATE_TASK = 'ticket.update.task';



    /**
     * @return string[]
     */
    public static function generalPermission(): array
    {
        return [
            self::USER_LIST,
            self::USER_VIEW,
            self::USER_CREATE,
            self::USER_UPDATE,
            self::USER_DELETE,

            self::COMPANY_LIST,
            self::COMPANY_VIEW,
            self::COMPANY_CREATE,
            self::COMPANY_UPDATE,
            self::COMPANY_DELETE,

            self::PROJECT_LIST,
            self::PROJECT_VIEW,
            self::PROJECT_CREATE,
            self::PROJECT_UPDATE,
            self::PROJECT_DELETE,

            self::TICKET_LIST,
            self::TICKET_VIEW,
            self::TICKET_CREATE,
            self::TICKET_UPDATE,
            self::TICKET_DELETE,
            self::TICKET_ACCEPT_TASK,
            self::TICKET_UPDATE_TASK,
        ];
    }

    /**
     * @return string[]
     */
    public static function generalPermissionByGroup(): array
    {
        return [
            self::GROUP_USER => [
                self::USER_LIST,
                self::USER_VIEW,
                self::USER_CREATE,
                self::USER_UPDATE,
                self::USER_DELETE,
            ],

            self::GROUP_COMPANY => [
                self::COMPANY_LIST,
                self::COMPANY_VIEW,
                self::COMPANY_CREATE,
                self::COMPANY_UPDATE,
                self::COMPANY_DELETE,
            ],

            self::GROUP_PROJECT => [
                self::PROJECT_LIST,
                self::PROJECT_VIEW,
                self::PROJECT_CREATE,
                self::PROJECT_UPDATE,
                self::PROJECT_DELETE,
            ],

            self::GROUP_TICKET => [
                self::TICKET_LIST,
                self::TICKET_VIEW,
                self::TICKET_CREATE,
                self::TICKET_UPDATE,
                self::TICKET_DELETE,
                self::TICKET_ACCEPT_TASK,
                self::TICKET_UPDATE_TASK,
            ],

        ];
    }

    /**
     * @return \array[][]
     */
    public static function getPermissionByGroup(): array
    {
        return [
            self::GROUP_USER => [
                self::USER_LIST => [
                    Role::SUPER_ADMIN,
                    Role::ADMIN,
                ],
                self::USER_VIEW => [
                    Role::SUPER_ADMIN,
                    Role::ADMIN
                ],
                self::USER_CREATE => [
                    Role::SUPER_ADMIN,
                    Role::ADMIN

                ],
                self::USER_UPDATE => [
                    Role::SUPER_ADMIN,
                    Role::ADMIN
                ],
                self::USER_DELETE => [
                    Role::SUPER_ADMIN,
                    Role::ADMIN
                ]
            ],

            self::GROUP_COMPANY => [
                self::COMPANY_LIST => [
                    Role::SUPER_ADMIN,
                    Role::ADMIN
                ],
                self::COMPANY_VIEW => [
                    Role::SUPER_ADMIN,
                    Role::ADMIN
                ],
                self::COMPANY_CREATE => [
                    Role::SUPER_ADMIN,
                    Role::ADMIN
                ],
                self::COMPANY_UPDATE => [
                    Role::SUPER_ADMIN,
                    Role::ADMIN
                ],
                self::COMPANY_DELETE => [
                    Role::SUPER_ADMIN,
                    Role::ADMIN
                ]
            ],

            self::GROUP_PROJECT => [
                self::PROJECT_LIST => [
                    Role::SUPER_ADMIN,
                    Role::ADMIN
                ],
                self::PROJECT_VIEW => [
                    Role::SUPER_ADMIN,
                    Role::ADMIN
                ],
                self::PROJECT_CREATE => [
                    Role::SUPER_ADMIN,
                    Role::ADMIN
                ],
                self::PROJECT_UPDATE => [
                    Role::SUPER_ADMIN,
                    Role::ADMIN
                ],
                self::PROJECT_DELETE => [
                    Role::SUPER_ADMIN,
                    Role::ADMIN
                ]
            ],

            self::GROUP_TICKET => [
                self::TICKET_LIST => [
                    Role::SUPER_ADMIN,
                    Role::ADMIN,
                    Role::USER,
                    Role::STAFF,
                ],
                self::TICKET_VIEW => [
                    Role::SUPER_ADMIN,
                    Role::ADMIN,
                    Role::USER,
                    Role::STAFF,
                ],
                self::TICKET_CREATE => [
                    Role::USER,
                    Role::SUPER_ADMIN,
                ],
                self::TICKET_UPDATE => [
                    Role::SUPER_ADMIN,
                    Role::ADMIN,
                    Role::USER,
                    Role::STAFF,
                ],
                self::TICKET_DELETE => [
                    Role::SUPER_ADMIN,
                    Role::ADMIN,
                    Role::USER,
                    Role::STAFF,
                ],

                self::TICKET_ACCEPT_TASK => [
                    Role::STAFF
                ],

                self::TICKET_UPDATE_TASK => [
                    Role::STAFF
                ]

            ]
        ];
    }


    /**
     * @param $selectedRole
     * @return array
     */
    public static function getPermissionByRole($selectedRole): array
    {
        $hasPermission = [];

        foreach (Permission::getPermissionByGroup() as $group => $permissions) {
            foreach ($permissions as $permission => $roles) {
                foreach ($roles as $role) {
                    if ($role == $selectedRole) {
                        $hasPermission[] = $permission;
                    }
                }
            }
        }
        return $hasPermission;
    }
}
