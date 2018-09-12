import {
  RECEIVE_USER,
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
  reqLogin,
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
  reqRegUser,
} from '../api';
export default {
  async getUser({commit}, data) {
    const result = await reqLogin(data);
    if (result.resCode === 1) {
      commit(RECEIVE_USER, result.resData);
    }
    return result.resCode;
  },
  async regUser({commit}, data) {
    const result = reqRegUser(data);
    if (result.resCode === 1) {
      commit(RECEIVE_USER, result.resData);
    }
    return result.resCode;
  },
  async getSaveList({commit}, data) {
    const result = await reqSaveList(data);
    commit(RECEIVE_SAVELIST, result.resData);
    return result.resCode;
  },
  async addItem({commit}, data) {
    const result = await reqAddItem(data);
    commit(RECEIVE_ADDITEM, result.resData);
    return result.resCode;
  },
  async updateLink({commit}, data) {
    const result = await reqUpdateItem(data);
    commit(RECEIVE_UPDATEITEM, result.resData);
    return result.resCode;
  },
  async deleteItem({commit}, data) {
    const result = await reqDeleteItem(data);
    commit(RECEIVE_DELETEITEM, result.resData);
    return result.resCode;
  },
  logOut({commit}) {
    window.localStorage.boring = '';
    commit(LOGOUT);
  },
  async quitGroup({commit}, data) {
    const result = await reqQuitGroup(data);
    commit(RECEIVE_QUITGROUP, result.resData);
    return result.resCode;
  },
  async newGroup({dispatch, commit}, data) {
    const result = await reqNewGroup(data);
    commit(RECEIVE_NEWGROUP, result.resData);
    dispatch('getSaveList', {userId: result.resData.userId});
    return result.resCode;
  },
  async joinGroup({dispatch, commit}, data) {
    const result = await reqJoinGroup(data);
    commit(RECEIVE_JOINGROUP, result.resData);
    dispatch('getSaveList', {userId: result.resData.userId});
    return result.resCode;
  },
  async pushGroup(context, data) {
    const result = await reqPushGroup(data);
    return result.resCode;
  },
  async agree({commit}, data) {
    const result = await reqAgree(data);
    commit(RECEIVE_HANDLEPUSH, result.linkId);
    return result.resCode;
  },
  async reject({commit}, data) {
    const result = await reqReject(data);
    commit(RECEIVE_HANDLEPUSH, result.linkId);
    return result.resCode;
  },
};
