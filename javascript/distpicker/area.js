function showLocation(province , city , town) {

	var loc	= new Location();
	var title	= ['省份' , '地级市' , '市、县、区'];
	$.each(title , function(k , v) {
		title[k]	= '<option value="">'+v+'</option>';
	})

    //省，市，县三级参数齐全时，默认显示这三级的地名
    if(province !== undefined && city !== undefined && town !== undefined && province != 0){
        var title1 = [loc.items[0][province],loc.items['0,'+province][city],loc.items['0,'+province+','+city][town]],
            area = [province,city,town];
        $.each(title1 , function(k , v) {
            title1[k]	= '<option value="'+area[k]+'">'+v+'</option>';
        })
        $('#loc_province').append(title1[0]);
        $('#loc_city').append(title1[1]);
        $('#loc_town').append(title1[2]);
    }else{
        $('#loc_province').append(title[0]);
        $('#loc_city').append(title[1]);
        $('#loc_town').append(title[2]);
    }

	$('#loc_province').change(function() {
		$('#loc_city').empty();
		$('#loc_city').append(title[1]);
		loc.fillOption('loc_city' , '0,'+$('#loc_province').val());
		$('#loc_town').empty();
		$('#loc_town').append(title[2]);
		//$('input[@name=location_id]').val($(this).val());
	})

	$('#loc_city').change(function() {
		$('#loc_town').empty();
		$('#loc_town').append(title[2]);
		loc.fillOption('loc_town' , '0,' + $('#loc_province').val() + ',' + $('#loc_city').val());
		//$('input[@name=location_id]').val($(this).val());
	})

	$('#loc_town').change(function() {
		$('input[name=location_id]').val($(this).val());
	})

	if (province) {
		loc.fillOption('loc_province' , '0' , province);

		if (city) {
			loc.fillOption('loc_city' , '0,'+province , city);

			if (town) {
				loc.fillOption('loc_town' , '0,'+province+','+city , town);
			}
		}

	} else {
		loc.fillOption('loc_province' , '0');
	}

}
