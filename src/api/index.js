import ajax from './ajax';
// 后端目前全部提供的 GET 请求
export const reqBgImg = data => ajax('/getRandomScreensaver.php', data, 'GET');
export const reqUser = data => ajax('/usersLogin.php', data, 'POST');
export const reqSaveList = data => ajax('/getFavoriteLinks.php', data, 'GET');
export const reqAddItem = data => ajax('/saveFavoriteLinks.php', data, 'GET');
export const reqUpdateItem = data => ajax('/updateFavoriteLinks.php', data, 'GET');
export const reqDeleteItem = data => ajax('/daleteItem.php', data, 'GET');
export const reqQuitGroup = data => ajax('/clearKEY.php', data, 'GET');
export const reqNewGroup = data => ajax('/generateKEY.php', data, 'GET');
export const reqJoinGroup = data => ajax('/submitKEY.php', data, 'GET');
export const reqPushGroup = data => ajax('/addLinkOfGroup.php', data, 'GET');
export const reqAgree = data => ajax('/agree.php', data, 'GET');
export const reqReject = data => ajax('/reject.php', data, 'GET');
