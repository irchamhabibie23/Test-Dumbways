function drawImage (a){
    mid = Math.floor(a/2)
    arr = Array(a)
    for(j=0; j<a ; j++){
      arr.splice(j,1,"=")
    }
    arr[mid]="*"
    if (a%2 == 1){
      for(i=0; i<a ; i++){
        if (i%mid==0){
          arr[0]="*"
          arr[a-1]="*"
        }
        if (i==mid){
          for(j=0; j<a ; j++){
            arr.splice(j,1,"*")
          }
        }
        console.log(arr)
        for(j=0; j<a ; j++){
          arr.splice(j,1,"=")
        }
        arr[mid]="*"
      }
    }
  }