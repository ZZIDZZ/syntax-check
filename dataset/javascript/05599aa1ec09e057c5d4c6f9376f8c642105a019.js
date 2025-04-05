function injectAsyncLoadPageJS(data) {
  let injectHtml = `<script>${asyncLoadPageJSTpl}</script>`;

  if (data.indexOf(injectHtml) === -1) {
    data = data.replace('</head>', injectHtml);
  }

  return data;
}