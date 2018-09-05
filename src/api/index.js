import ajax from './ajax';
// 后端目前全部提供的 GET 请求
export const reqBgImg = url => ajax(url);
export const reqUser = (url, data) => ajax(url, data, 'GET');
export const reqSaveList = (url, data) => ajax(url, data, 'GET');
export const reqAddItem = (url, data) => ajax(url, data, 'GET');
export const reqUpdateItem = (url, data) => ajax(url, data, 'GET');
export const reqDeleteItem = (url, data) => ajax(url, data, 'GET');
export const reqQuitGroup = (url, data) => ajax(url, data, 'GET');
export const reqNewGroup = (url, data) => ajax(url, data, 'GET');
export const reqJoinGroup = (url, data) => ajax(url, data, 'GET');
export const reqPushGroup = (url, data) => ajax(url, data, 'GET');
export const reqAgree = (url, data) => ajax(url, data, 'GET');
export const reqReject = (url, data) => ajax(url, data, 'GET');
