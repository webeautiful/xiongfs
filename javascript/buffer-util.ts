// THX: https://mp.weixin.qq.com/s/2M_8K47I_fON9ba8nZODNw

// 文本转字节数组
export function text2ByteArray(text) {
    // 文本转字节流
    const encoder = new TextEncoder()
    const view = encoder.encode(text)
    // buffer转二进制
    return Array.from(view)
}

// 字节数组转文本
export function byteArray2Text(byteList, encoding = 'utf-8') {
    // 根据字节数组生成buffer
    const buffer = new ArrayBuffer(byteList.length)
    const view = new Uint8Array(buffer);
    for (var i = 0; i < byteList.length; ++i) {
        view[i] = byteList[i]
    }
    // 字节流转文本
    const decoder = new TextDecoder(encoding)
    return decoder.decode(buffer)
}