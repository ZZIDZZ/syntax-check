def enable_component_notification(self, openstack_component):
        """
        Check if customer enable openstack component notification.

        :param openstack_component: Openstack component type.
        """
        openstack_component_mapping = {
            Openstack.Nova: self.config.listen_nova_notification,
            Openstack.Cinder: self.config.listen_cinder_notification,
            Openstack.Neutron: self.config.listen_neutron_notification,
            Openstack.Glance: self.config.listen_glance_notification,
            Openstack.Swift: self.config.listen_swift_notification,
            Openstack.Keystone: self.config.listen_keystone_notification,
            Openstack.Heat: self.config.listen_heat_notification
        }
        return openstack_component_mapping[openstack_component]