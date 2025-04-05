def remove_hotkey(control, key):
 """
 Remove a global hotkey.
 
 control - The control to affect
 key - The key to remove.
 """
 l = _hotkeys.get(control, [])
 for a in l:
  key_str, id = a
  if key_str == key:
   control.Unbind(wx.EVT_HOTKEY, id = id)
   control.UnregisterHotKey(id)
   l.remove(a)
   if l:
    _hotkeys[control] = l
   else:
    del _hotkeys[control]