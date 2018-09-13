export default {
  isMaster(state) {
    if (!state.hashList.length) {
      return false;
    }
    return state.hashList[0].groupLord === state.user.userId;
  },
};
