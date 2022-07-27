//import { computed, ref } from "vue";

const useAjax = () => {

    const getFamilyData = async (id) => {

        return await axios({
            method: 'post',
            url: '/ajax/family/getinfo',
            data: {
              id,
            }
          });
    };

    return{
        getFamilyData,
    }


}

export default useAjax;