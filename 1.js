function check(dataArray, word) {
    for (var i = 0; i < dataArray.length; i++) {
        console.log(dataArray[i] + ' => ' + ((word.search(dataArray[i]) >= 0 ? "true" : "false")));
    }
}

var dataKey = ['dumb', 'ways', 'the', 'best', 'way'];
var word = 'dumbways';


check(dataKey, word)
