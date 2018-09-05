import {
  RECEIVE_SAVELIST,
  RECEIVE_ADDITEM,
  RECEIVE_UPDATEITEM,
  RECEIVE_DELETEITEM,
  RECEIVE_QUITGROUP,
  RECEIVE_NEWGROUP,
  RECEIVE_JOINGROUP,
  RECEIVE_HANDLEPUSH,
  LOGOUT,
} from './mutation-types.js';
import {
  reqSaveList,
  reqAddItem,
  reqUpdateItem,
  reqDeleteItem,
  reqQuitGroup,
  reqNewGroup,
  reqJoinGroup,
  reqPushGroup,
  reqAgree,
  reqReject,
} from '../api';
export default {
  async getSaveList({commit}, data) {
    const URL = '/getFavoriteLinks.php';
    const result = await reqSaveList(URL, data);
    if (result.resCode === 1) {
      commit(RECEIVE_SAVELIST, result.resData);
    } else {
      console.log('获取失败');
    }
  },
  async addItem({commit}, data) {
    const URL = '/saveFavoriteLinks.php';
    const result = await reqAddItem(URL, data);
    if (result.resCode === 1) {
      commit(RECEIVE_ADDITEM, result.resData);
    } else {
      console.log('添加失败');
    }
  },
  async updateLink({commit}, data) {
    const URL = '/updateFavoriteLinks.php';
    const result = await reqUpdateItem(URL, data);
    if (result.resCode === 1) {
      commit(RECEIVE_UPDATEITEM, result.resData);
    } else {
      console.log('修改失败');
    }
  },
  async deleteItem({commit}, data) {
    const URL = '';
    const result = await reqDeleteItem(URL, data);
    if (result.resCode === 1) {
      commit(RECEIVE_DELETEITEM, result.resData);
    } else {
      console.log('删除失败');
    }
  },
  logOut({commit}) {
    window.localStorage.boring = '';
    commit(LOGOUT);
  },
  async quitGroup({commit}, data) {
    const URL = '/clearKEY.php';
    const result = await reqQuitGroup(URL, data);
    if (result.resCode === 1) {
      commit(RECEIVE_QUITGROUP, result.resData);
    } else {
      console.log('退出失败');
    }
  },
  async newGroup({dispatch, commit}, data) {
    const URL = '/generateKEY.php';
    const result = await reqNewGroup(URL, data);
    if (result.resCode === 1) {
      commit(RECEIVE_NEWGROUP, result.resData);
      dispatch('getSaveList', {userId: result.resData.userId});
    } else {
      console.log('创建失败');
    }
  },
  async joinGroup({dispatch, commit}, data) {
    const URL = '/submitKEY.php';
    const result = await reqJoinGroup(URL, data);
    if (result.resCode === 1) {
      commit(RECEIVE_JOINGROUP, result.resData);
      dispatch('getSaveList', {userId: result.resData.userId});
    } else {
      console.log('加入失败');
    }
  },
  async pushGroup({commit}, data) {
    const URL = '/addLinkOfGroup.php';
    const result = await reqPushGroup(URL, data);
    if (result.resCode === 1) {
      console.log('推送成功');
    } else {
      console.log('推送失败');
      commit();
    }
  },
  async agree({commit}, data) {
    const URL = '/agree.php';
    const result = await reqAgree(URL, data);
    if (result.resCode === 1) {
      commit(RECEIVE_HANDLEPUSH, result.linkId);
      console.log('已同意,但是后台没做');
    } else {
      console.log('同意失败');
    }
  },
  async reject({commit}, data) {
    const URL = '/reject.php';
    const result = await reqReject(URL, data);
    if (result.resCode === 1) {
      commit(RECEIVE_HANDLEPUSH, result.linkId);
      console.log('已拒绝,但是后台没做');
    } else {
      console.log('拒绝失败');
    }
  },
};
