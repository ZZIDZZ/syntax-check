private View createCustomViewInternal(View parent, View view, String name, Context context,
      AttributeSet attrs) {
    // I by no means advise anyone to do this normally, but Google have locked down access to
    // the createView() method, so we never get a callback with attributes at the end of the
    // createViewFromTag chain (which would solve all this unnecessary rubbish).
    // We at the very least try to optimise this as much as possible.
    // We only call for customViews (As they are the ones that never go through onCreateView(...)).
    // We also maintain the Field reference and make it accessible which will make a pretty
    // significant difference to performance on Android 4.0+.

    // If CustomViewCreation is off skip this.
    if (view == null && name.indexOf('.') > -1) {
      if (mConstructorArgs == null) {
        mConstructorArgs = ReflectionUtils.getField(LayoutInflater.class, "mConstructorArgs");
      }

      final Object[] mConstructorArgsArr =
          (Object[]) ReflectionUtils.getValue(mConstructorArgs, this);
      final Object lastContext = mConstructorArgsArr[0];
      mConstructorArgsArr[0] = parent != null ? parent.getContext() : context;
      ReflectionUtils.setValue(mConstructorArgs, this, mConstructorArgsArr);
      try {
        view = createView(name, null, attrs);
      } catch (ClassNotFoundException ignored) {
      } finally {
        mConstructorArgsArr[0] = lastContext;
        ReflectionUtils.setValue(mConstructorArgs, this, mConstructorArgsArr);
      }
    }
    return view;
  }