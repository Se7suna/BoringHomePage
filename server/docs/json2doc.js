const db = require('./db.json');
const handlebars = require('handlebars');
const fs = require('fs');
const {promisify} = require('util');
const {assign, map} = require('lodash');

const readFile = promisify(fs.readFile);
const writeFile = promisify(fs.writeFile);

(async () => {
  let template = await readFile('./doc.hbs', 'utf8');
  template = handlebars.compile(template);

  const formatted = map(db, (value, key) => {
    if (/^_/.test(key)) {
      return false;
    }

    const meta = db[`_${key}`];
    return assign({
      url: key,
      method: 'GET',
      response: JSON.stringify(value, null, '  ')
    }, meta, {
      request: JSON.stringify(meta.request, null, '  ')
    });
  });
  // console.log(JSON.stringify(formatted, null, '  '));
  await writeFile('./dist/'+ formatted[0].url +'.md', template({
    api: formatted.filter(item => !!item),
  }));
})();

