#!/usr/bin/perl

if(`pwd` ne "/storage0/backups/tchess\n") {
    `/usr/bin/rsync -e ssh --progress -acztv tchess\@64.71.173.180:/home/tchess/ .`
}else{
    print("lets get that into a dated dir!\n");
}
