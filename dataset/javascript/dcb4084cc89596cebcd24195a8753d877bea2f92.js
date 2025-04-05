function () {
    const gamepad = this.getGamepad();
    if (!gamepad.buttons[GamepadButton.DPAD_RIGHT]) {
      return new THREE.Vector2();
    }
    return new THREE.Vector2(
      (gamepad.buttons[GamepadButton.DPAD_RIGHT].pressed ? 1 : 0)
      + (gamepad.buttons[GamepadButton.DPAD_LEFT].pressed ? -1 : 0),
      (gamepad.buttons[GamepadButton.DPAD_UP].pressed ? -1 : 0)
      + (gamepad.buttons[GamepadButton.DPAD_DOWN].pressed ? 1 : 0)
    );
  }