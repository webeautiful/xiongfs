// 获取任意数字的有效小数位数
function getDecimalPlaces(number) {
    if (isNaN(number)) {
        return "Invalid input. Please provide a valid number.";
    }
    const scientificNotation = Number(number).toExponential();
    if (scientificNotation.includes('e+')) {
      const decimalPart = (Number(number).toString().split('.')[1] || '').length;
      return decimalPart;
    } else {
      const decimalPart = 1 * scientificNotation.split('e-')[1] || 0
      return decimalPart;
    }
}

// 对任意数字进行格式化，并保留指定小数位数，位数不够的补0
function formatNumber(number, decimalPlaces) {
    if (isNaN(number) || isNaN(decimalPlaces)) {
        return "Invalid input. Please provide a valid number and decimal places.";
    }

    const roundedNumber = Number(number).toFixed(decimalPlaces);
    const [integerPart, decimalPart] = roundedNumber.split('.');

    let formattedNumber = integerPart;
    if (decimalPlaces > 0) {
        formattedNumber += '.';
        if (decimalPart) {
            formattedNumber += decimalPart.padEnd(decimalPlaces, '0');
        } else {
            formattedNumber += '0'.repeat(decimalPlaces);
        }
    }

    return formattedNumber;
}

// maskStr('0x95222290DD7278Aa3Ddd389Cc1E1d165CC4BAfe5') // 0x95...Afe5
function maskStr(str, len=4, padLen=3) {
  if (str.length <= len * 2) {
    return str
  }

  const prefix = str.slice(0, len)
  const suffix = str.slice(-(len+1))
  const maskedPart = ''.padStart(padLen, '.')

  return prefix + maskedPart + suffix
}