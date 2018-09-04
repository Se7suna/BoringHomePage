import ajax from './ajax'
export const reqBgImg = url => ajax(url)
export const reqUser = (url, data) => ajax(url, data)
export const reqSaveList = (url, data) => ajax(url, data)
export const reqAddItem = (url, data) => ajax(url, data)
export const reqNewGroup = url => ajax(url)
