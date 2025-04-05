function getByID(id) {
  var url = `${APP_BASE_URL}Detail.aspx?id=${id}`;
  return request(url)
    .then(function(body) {
      let $ = cheerio.load(body);

      let info = {
        url: url,
        id: id
      };

      $('table#searchTableResults tr').each((i, item) => {
        let span = $(item).find('span');
        let key = $(span).attr('id').replace('ctl00_Application_lbl', '').toLowerCase();
        let value = $(span).text().trim();
        info[translations[key] || key] = value;
      });
      info.stolendate = getStandardizedDateStr(info.stolendate);
      return info;
    });
}