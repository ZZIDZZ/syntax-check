def show_context_menu(self, item, mouse_pos=None):
        "Open a popup menu with options regarding the selected object"
        if item:
            d = self.tree.GetItemData(item)
            if d:
                obj = d.GetData()
                if obj:
                    # highligh and store the selected object:
                    self.highlight(obj.wx_obj)
                    self.obj = obj
                    
                    # make the context menu
                    menu = wx.Menu()
                    id_del, id_dup, id_raise, id_lower = [wx.NewId() for i
                                                            in range(4)]
                    menu.Append(id_del, "Delete")
                    menu.Append(id_dup, "Duplicate")
                    menu.Append(id_raise, "Bring to Front")
                    menu.Append(id_lower, "Send to Back")

                    # make submenu!
                    sm = wx.Menu()
                    for ctrl in sorted(obj._meta.valid_children,
                                       key=lambda c: 
                                            registry.ALL.index(c._meta.name)):
                        new_id = wx.NewId()
                        sm.Append(new_id, ctrl._meta.name)
                        self.Bind(wx.EVT_MENU, 
                                  lambda evt, ctrl=ctrl: self.add_child(ctrl, mouse_pos), 
                                  id=new_id)
                        
                    menu.AppendMenu(wx.NewId(), "Add child", sm)

                    self.Bind(wx.EVT_MENU, self.delete, id=id_del)
                    self.Bind(wx.EVT_MENU, self.duplicate, id=id_dup)
                    self.Bind(wx.EVT_MENU, self.bring_to_front, id=id_raise)
                    self.Bind(wx.EVT_MENU, self.send_to_back, id=id_lower)

                    self.PopupMenu(menu)
                    menu.Destroy()
                    self.load_object(self.root_obj)