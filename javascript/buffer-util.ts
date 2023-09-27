// THX: https://mp.weixin.qq.com/s/2M_8K47I_fON9ba8nZODNw

// 字节数转16进制字符串
function byte2hexStr(byte) {
    if (typeof byte !== 'number')
        throw new Error('Input must be a number');

    if (byte < 0 || byte > 255)
        throw new Error('Input must be a byte');

    const hexByteMap = '0123456789ABCDEF';

    let str = '';
    str += hexByteMap.charAt(byte >> 4);
    str += hexByteMap.charAt(byte & 0x0f);

    return str;
}

// 文本转字节数组
export function text2byteArray(text) {
    // 文本转字节流
    const encoder = new TextEncoder()
    const view = encoder.encode(text)
    // buffer转二进制
    return Array.from(view)
}

// alias - 文本转码位列表
export const text2codePointList = text2byteArray

// 字节数组转文本
export function byteArray2text(byteList, encoding = 'utf-8') {
    // 以字节为单位分配指定长度的内存区
    const buffer = new ArrayBuffer(byteList.length)
    // 将数据依次写入字节位
    const view = new Uint8Array(buffer);
    for (let i = 0; i < byteList.length; ++i) {
        view[i] = byteList[i]
    }
    // 字节流转文本
    const decoder = new TextDecoder(encoding)
    return decoder.decode(buffer)
}

// alias - 码位列表转文本
export const codePointList2text = byteArray2text
