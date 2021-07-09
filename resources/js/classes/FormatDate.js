
class FormatDate{

    static format(date){
        let d = new Date(date);
        let dy = d.getDate();
        let m = d.getMonth() + 1;
        let y = d.getFullYear();

        if(dy < 10) dy = '0' + dy;
        if(m < 10) m = '0' + m;

        return `${dy}/${m}/${y}`;
    }

}

export default FormatDate;
