cat "$1" |sed -E 's/<img[^>]*src=".?\/Handlers\/Image.ashx\?[^>]*name=([^&]*)&[^>]*>/\{\1\}/g' |sed -E 's/<img[^>]*src="\.\.\/\.\.\/Handlers\/Image.ashx\?[^>]*set=([^&]*)&[^>]*>/\1, /g' > "$1.ok"
