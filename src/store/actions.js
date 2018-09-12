import {
  RECEIVE_USER,
  RECEIVE_SAVELIST,
  RECEIVE_ADDLINK,
  RECEIVE_UPDATEITEM,
  RECEIVE_DELETEITEM,
  RECEIVE_QUITGROUP,
  RECEIVE_NEWGROUP,
  RECEIVE_JOINGROUP,
  RECEIVE_HANDLEPUSH,
  RECEIVE_GETHASH,
  LOGOUT,
} from './mutation-types.js';
import {
  reqLogin,
  reqGroupLink,
  reqAddLink,
  reqUpdateItem,
  reqDeleteItem,
  reqQuitGroup,
  reqNewGroup,
  reqJoinGroup,
  reqPushGroup,
  reqAgree,
  reqReject,
  reqRegUser,
  reqGetHash,
} from '../api';
export default {
  async userLogin({commit}, data) {
    const result = await reqLogin(data);
    if (+result.resInfo === 1) {
      commit(RECEIVE_USER, result.resData);
    }
    return result.resInfo;
  },
  async regUser({commit}, data) {
    const result = await reqRegUser(data);
    if (result.resCode === 1) {
      commit(RECEIVE_USER, result.resData);
    }
    return result.resCode;
  },
  async getHash({commit}, data) {
    const result = await reqGetHash(data);
    if (result.resCode === 1) {
      commit(RECEIVE_GETHASH, result.resData.dataList);
    }
    return result.resCode;
  },
  async getGroupLink({commit}, data) {
    for (let i of data) {
      const result = await reqGroupLink(i);
      if (result.resCode === 1) {
        commit(RECEIVE_SAVELIST, result.resData);
      }
    }
  },
  async addLink({commit}, data) {
    const result = await reqAddLink(data);
    commit(RECEIVE_ADDLINK, result.resData);
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
  async newGroup({commit}, data) {
    const result = await reqNewGroup(data);
    if (result.resCode === 1) {
      commit(RECEIVE_NEWGROUP, result.resData);
    }
    return result.resCode;
  },
  async joinGroup({dispatch, state, commit}, data) {
    const result = await reqJoinGroup(data);
    if (result.resCode === 1) {
      commit(RECEIVE_JOINGROUP, result.resData);
      dispatch('getGroupLink', state.hashList);
    }
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
