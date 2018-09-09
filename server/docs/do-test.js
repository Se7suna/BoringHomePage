/*
 * Created on Sat Sep 08 2018
 * 此文件用作文档测试, 检测 接口实际返回的值是否与 文档中的值 匹配
 * Copyright (c) 2018 Your Company
 */

const db = require('./db.json');
const {each, map} = require('lodash');
const BASE_URL = 'https://my-awesome-pro.com/api/';
const axios = require('axios');

(async () => {

  each(db, (value, key) => {
    if (!/^_/.test(key)) {
      return false;
    }

    const url = key.substr(1);
    const sample = db[url];
    axios[value.method || 'get'](`${BASE_URL}${url}`)
      .then(response => {
        response.should.be.eql(sample);
      })
  });
})();

