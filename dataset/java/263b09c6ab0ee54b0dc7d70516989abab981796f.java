public static boolean isValidOTPFormat(String otp) {
		if (otp == null){
			return false;
		}		
		int len = otp.length();
		for (char c : otp.toCharArray()) {
			if (c < 0x20 || c > 0x7E) {
				return false;
			}
		}
		return OTP_MIN_LEN <= len && len <= OTP_MAX_LEN;
	}