function waktu(){
    jarak = 64500
    kecepatan = 3
    lamaPerjalanan1 = 23*60
    jarakTempuh = kecepatan * lamaPerjalanan1
    jarak = jarak - jarakTempuh
    kecepatan = 5
    lamaPerjalanan2 = 12*60
    jarakTempuh = kecepatan * lamaPerjalanan2
    jarak = jarak - jarakTempuh
    kecepatan = 2
    lamaWaktu = (jarak/kecepatan) + lamaPerjalanan1 + lamaPerjalanan2 
    lamaJam = Math.floor(lamaWaktu/3600)
    lamaWaktu = lamaWaktu%3600
    lamaMenit = Math.floor(lamaWaktu/60)
    lamaDetik = lamaWaktu%60
    console.log (lamaJam + " Jam")
    console.log (lamaMenit + " Menit")
    console.log (lamaDetik + " Detik")
}

console.log(waktu())