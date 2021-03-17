function tesreverse (a){
    var b = []
    for (i=a.length-1 ; i>=0 ; i--){
      b.push(a[i])
    }
    console.log (b)
}

console.log(tesreverse([1,2,3,4,5]))