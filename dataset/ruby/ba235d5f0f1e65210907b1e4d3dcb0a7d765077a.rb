def challah_role
      unless included_modules.include?(InstanceMethods)
        include InstanceMethods
        extend ClassMethods
      end

      class_eval do
        # Validations
        ################################################################

        validates :name, :presence => true, :uniqueness => true

        # Relationships
        ################################################################

        has_many :permission_roles,   :dependent => :destroy

        has_many :permissions,        :through => :permission_roles,
                                      :order => 'permissions.name'

        has_many :users,              :order => 'users.first_name, users.last_name'

        # Scoped Finders
        ################################################################

        default_scope order('roles.name')

        # Callbacks
        ################################################################

        after_save :save_permission_keys

        # Attributes
        ################################################################

        attr_accessible :description, :default_path, :locked, :name
      end
    end