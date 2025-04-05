function FormioResourceRoutes(config) {
    config = config || {};
    return [
        {
            path: '',
            component: config.index || index_component_1.FormioResourceIndexComponent
        },
        {
            path: 'new',
            component: config.create || create_component_1.FormioResourceCreateComponent
        },
        {
            path: ':id',
            component: config.resource || resource_component_1.FormioResourceComponent,
            children: [
                {
                    path: '',
                    redirectTo: 'view',
                    pathMatch: 'full'
                },
                {
                    path: 'view',
                    component: config.view || view_component_1.FormioResourceViewComponent
                },
                {
                    path: 'edit',
                    component: config.edit || edit_component_1.FormioResourceEditComponent
                },
                {
                    path: 'delete',
                    component: config.delete || delete_component_1.FormioResourceDeleteComponent
                }
            ]
        }
    ];
}