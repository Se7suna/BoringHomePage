import ajax from './ajax'
export const reqBgImg = url => ajax(url)
export const reqNewGroup = url => ajax(url)
export const reqUser = (url, data) => ajax(url, data)
