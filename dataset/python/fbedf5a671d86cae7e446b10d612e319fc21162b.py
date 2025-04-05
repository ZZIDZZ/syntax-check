def _insert_img(qr_img, icon_img=None, factor=4, icon_box=None, static_dir=None):
        """Inserts a small icon to QR Code image"""
        img_w, img_h = qr_img.size
        size_w = int(img_w) / int(factor)
        size_h = int(img_h) / int(factor)

        try:
            # load icon from current dir
            icon_fp = os.path.join(icon_img)
            if static_dir:
                # load icon from app's static dir
                icon_fp = os.path.join(static_dir, icon_img)
            if icon_img.split("://")[0] in ["http", "https", "ftp"]:
                icon_fp = BytesIO(urlopen(icon_img).read())  # download icon
            icon = Image.open(icon_fp)
        except:
            return qr_img

        icon_w, icon_h = icon.size
        icon_w = size_w if icon_w > size_w else icon_w
        icon_h = size_h if icon_h > size_h else icon_h
        icon = icon.resize((int(icon_w), int(icon_h)), Image.ANTIALIAS)
        icon = icon.convert("RGBA")

        left = int((img_w - icon_w) / 2)
        top = int((img_h - icon_h) / 2)
        icon_box = (int(icon_box[0]), int(icon_box[1])) if icon_box else (left, top)
        qr_img.paste(im=icon, box=icon_box, mask=icon)
        return qr_img