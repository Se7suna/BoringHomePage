import ajax from './ajax';
// 后端目前全部提供的 GET 请求
export const reqBgImg = data => ajax(data, '/getRandomScreensaver.php', 'GET');
export const reqUser = data => ajax(data, '/usersLogin.php', 'POST');
export const reqSaveList = data => ajax(data, '/getFavoriteLinks.php', 'GET');
export const reqAddItem = data => ajax(data, '/saveFavoriteLinks.php', 'GET');
export const reqUpdateItem = data => ajax(data, '/updateFavoriteLinks.php', 'GET');
export const reqDeleteItem = data => ajax(data, '/daleteItem.php', 'GET');
export const reqQuitGroup = data => ajax(data, '/clearKEY.php', 'GET');
export const reqNewGroup = data => ajax(data, '/generateKEY.php', 'GET');
export const reqJoinGroup = data => ajax(data, '/submitKEY.php', 'GET');
export const reqPushGroup = data => ajax(data, '/addLinkOfGroup.php', 'GET');
export const reqAgree = data => ajax(data, '/agree.php', 'GET');
export const reqReject = data => ajax(data, '/reject.php', 'GET');
