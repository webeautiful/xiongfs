// THX: https://mp.weixin.qq.com/s/2M_8K47I_fON9ba8nZODNw

// 文本转二进制数组
export function text2BinaryList(text) {
    // 文本转buffer
    const encoder = new TextEncoder()
    const buffer = encoder.encode(text)
    // buffer转二进制
    return Array.from(buffer)
}

// 二进制数组转字符串
export function binaryList2Text(binaryList, encoding = 'utf-8') {
    // 二进制转buffer
    const buffer = new ArrayBuffer(binaryList.length)
    const view = new Uint8Array(buffer);
    for (var i = 0; i < binaryList.length; ++i) {
        view[i] = binaryList[i]
    }
    // buffer转字符串
    const decoder = new TextDecoder(encoding)
    return decoder.decode(buffer)
}