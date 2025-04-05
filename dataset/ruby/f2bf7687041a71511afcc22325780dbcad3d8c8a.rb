def draw_paperback(qr_code:, sixword_lines:, sixword_bytes:, labels:,
                     passphrase_sha: nil, passphrase_len: nil,
                     sixword_font_size: nil, base64_content: nil,
                     base64_bytes: nil)
    unless qr_code.is_a?(RQRCode::QRCode)
      raise ArgumentError.new('qr_code must be RQRCode::QRCode')
    end

    # Header & QR code page
    pdf.font('Times-Roman')

    debug_draw_axes

    draw_header(labels: labels, passphrase_sha: passphrase_sha,
                passphrase_len: passphrase_len)

    add_newline

    draw_qr_code(qr_modules: qr_code.modules)

    pdf.stroke_color '000000'
    pdf.fill_color '000000'

    # Sixword page

    pdf.start_new_page

    draw_sixword(lines: sixword_lines, sixword_bytes: sixword_bytes,
                 font_size: sixword_font_size,
                 is_encrypted: passphrase_len)

    if base64_content
      draw_base64(b64_content: base64_content, b64_bytes: base64_bytes,
                  is_encrypted: passphrase_len)
    end

    pdf.number_pages('<page> of <total>', align: :right,
                     at: [pdf.bounds.right - 100, -2])
  end